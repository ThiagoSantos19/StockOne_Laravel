<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $pedidos = Pedido::with(['restaurante', 'usuario'])
            ->where('restaurante_id', $restauranteId)
            ->orderByDesc('data_hora_pedido')
            ->paginate(12);

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $usuarios = User::orderBy('name')->pluck('name', 'id');

        return view('pedidos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => ['nullable', 'exists:users,id'],
            'numero_pedido_externo' => ['nullable', 'string', 'max:255'],
            'plataforma_origem' => ['required', 'string', 'max:100'],
            'data_hora_pedido' => ['required', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'valor_total' => ['nullable', 'numeric'],
            'tempo_preparo_estimado' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['restaurante_id'] = $this->restauranteId();

        Pedido::create($data);

        return redirect()->route('pedidos.index')->with('success', 'Pedido registrado com sucesso.');
    }

    public function edit(Pedido $pedido)
    {
        $this->authorizePedido($pedido);

        $usuarios = User::orderBy('name')->pluck('name', 'id');

        return view('pedidos.edit', compact('pedido', 'usuarios'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $this->authorizePedido($pedido);

        $data = $request->validate([
            'usuario_id' => ['nullable', 'exists:users,id'],
            'numero_pedido_externo' => ['nullable', 'string', 'max:255'],
            'plataforma_origem' => ['required', 'string', 'max:100'],
            'data_hora_pedido' => ['required', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'valor_total' => ['nullable', 'numeric'],
            'tempo_preparo_estimado' => ['nullable', 'integer', 'min:0'],
        ]);

        $pedido->update($data);

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido)
    {
        $this->authorizePedido($pedido);

        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido removido com sucesso.');
    }

    protected function restauranteId(): int
    {
        return (int) session('restaurante_id');
    }

    protected function authorizePedido(Pedido $pedido): void
    {
        abort_unless($pedido->restaurante_id === $this->restauranteId(), 403);
    }
}