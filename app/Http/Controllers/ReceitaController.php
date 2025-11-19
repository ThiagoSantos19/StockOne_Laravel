<?php

namespace App\Http\Controllers;

use App\Models\CardapioItem;
use App\Models\Insumo;
use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReceitaController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $receitas = Receita::with(['cardapioItem', 'insumo'])
            ->whereHas('cardapioItem', fn ($query) => $query->where('restaurante_id', $restauranteId))
            ->orderBy('cardapio_item_id')
            ->paginate(15);

        return view('receitas.index', compact('receitas'));
    }

    public function create()
    {
        [$cardapioItens, $insumos] = $this->formOptions();

        return view('receitas.create', compact('cardapioItens', 'insumos'));
    }

    public function store(Request $request)
    {
        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'cardapio_item_id' => [
                'required',
                Rule::exists('cardapio_itens', 'id')->where('restaurante_id', $restauranteId),
            ],
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
            ],
            'quantidade_necessaria' => ['required', 'numeric'],
            'essencial' => ['nullable', 'boolean'],
        ]);

        $data['essencial'] = $request->boolean('essencial');

        Receita::create($data);

        return redirect()->route('receitas.index')->with('success', 'Receita vinculada com sucesso.');
    }

    public function edit(Receita $receita)
    {
        $this->authorizeReceita($receita);

        [$cardapioItens, $insumos] = $this->formOptions();

        return view('receitas.edit', compact('receita', 'cardapioItens', 'insumos'));
    }

    public function update(Request $request, Receita $receita)
    {
        $this->authorizeReceita($receita);

        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'cardapio_item_id' => [
                'required',
                Rule::exists('cardapio_itens', 'id')->where('restaurante_id', $restauranteId),
            ],
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
            ],
            'quantidade_necessaria' => ['required', 'numeric'],
            'essencial' => ['nullable', 'boolean'],
        ]);

        $data['essencial'] = $request->boolean('essencial');

        $receita->update($data);

        return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso.');
    }

    public function destroy(Receita $receita)
    {
        $this->authorizeReceita($receita);

        $receita->delete();

        return redirect()->route('receitas.index')->with('success', 'Receita removida com sucesso.');
    }

    protected function authorizeReceita(Receita $receita): void
    {
        abort_unless(optional($receita->cardapioItem)->restaurante_id === $this->restauranteId(), 403);
    }

    protected function formOptions(): array
    {
        $restauranteId = $this->restauranteId();

        $cardapioItens = CardapioItem::where('restaurante_id', $restauranteId)
            ->orderBy('nome')
            ->pluck('nome', 'id');

        $insumos = Insumo::where('restaurante_id', $restauranteId)
            ->orderBy('nome')
            ->pluck('nome', 'id');

        return [$cardapioItens, $insumos];
    }
}
