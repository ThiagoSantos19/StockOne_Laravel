<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstoqueController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $estoques = Estoque::with('insumo')
            ->whereHas('insumo', fn ($query) => $query->where('restaurante_id', $restauranteId))
            ->orderByDesc('updated_at')
            ->paginate(12);

        return view('estoque.index', compact('estoques'));
    }

    public function create()
    {
        $insumos = Insumo::where('restaurante_id', $this->restauranteId())
            ->doesntHave('estoque')
            ->orderBy('nome')
            ->pluck('nome', 'id');

        return view('estoque.create', compact('insumos'));
    }

    public function store(Request $request)
    {
        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
                Rule::unique('estoque', 'insumo_id'),
            ],
            'quantidade_atual' => ['required', 'numeric'],
            'localizacao' => ['nullable', 'string', 'max:255'],
        ]);

        Estoque::create($data);

        return redirect()->route('estoque.index')->with('success', 'Estoque registrado com sucesso.');
    }

    public function edit(Estoque $estoque)
    {
        $this->authorizeEstoque($estoque);

        $insumos = Insumo::where('restaurante_id', $this->restauranteId())
            ->orderBy('nome')
            ->pluck('nome', 'id');

        return view('estoque.edit', compact('estoque', 'insumos'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        $this->authorizeEstoque($estoque);

        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
                Rule::unique('estoque', 'insumo_id')->ignore($estoque->id),
            ],
            'quantidade_atual' => ['required', 'numeric'],
            'localizacao' => ['nullable', 'string', 'max:255'],
        ]);

        $estoque->update($data);

        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso.');
    }

    public function destroy(Estoque $estoque)
    {
        $this->authorizeEstoque($estoque);

        $estoque->delete();

        return redirect()->route('estoque.index')->with('success', 'Registro de estoque removido com sucesso.');
    }

    protected function restauranteId(): int
    {
        return (int) session('restaurante_id');
    }

    protected function authorizeEstoque(Estoque $estoque): void
    {
        abort_unless(optional($estoque->insumo)->restaurante_id === $this->restauranteId(), 403);
    }
}
