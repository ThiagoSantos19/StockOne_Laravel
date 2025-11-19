<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $insumos = Insumo::with('restaurante')
            ->where('restaurante_id', $restauranteId)
            ->orderBy('nome')
            ->paginate(12);

        return view('insumos.index', compact('insumos'));
    }

    public function create()
    {
        return view('insumos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:255'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'unidade_medida' => ['required', 'string', 'max:50'],
            'ponto_reposicao_minimo' => ['nullable', 'numeric'],
            'custo_unitario' => ['nullable', 'numeric'],
            'data_validade_minima' => ['nullable', 'date'],
        ]);

        $data['restaurante_id'] = $this->restauranteId();

        Insumo::create($data);

        return redirect()->route('insumos.index')->with('success', 'Insumo cadastrado com sucesso.');
    }

    public function edit(Insumo $insumo)
    {
        $this->authorizeInsumo($insumo);

        return view('insumos.edit', compact('insumo'));
    }

    public function update(Request $request, Insumo $insumo)
    {
        $this->authorizeInsumo($insumo);

        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:255'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'unidade_medida' => ['required', 'string', 'max:50'],
            'ponto_reposicao_minimo' => ['nullable', 'numeric'],
            'custo_unitario' => ['nullable', 'numeric'],
            'data_validade_minima' => ['nullable', 'date'],
        ]);

        $insumo->update($data);

        return redirect()->route('insumos.index')->with('success', 'Insumo atualizado com sucesso.');
    }

    public function destroy(Insumo $insumo)
    {
        $this->authorizeInsumo($insumo);

        $insumo->delete();

        return redirect()->route('insumos.index')->with('success', 'Insumo removido com sucesso.');
    }

    protected function restauranteId(): int
    {
        return (int) session('restaurante_id');
    }

    protected function authorizeInsumo(Insumo $insumo): void
    {
        abort_unless($insumo->restaurante_id === $this->restauranteId(), 403);
    }
}
