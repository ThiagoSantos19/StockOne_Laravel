<?php

namespace App\Http\Controllers;

use App\Models\CardapioItem;
use Illuminate\Http\Request;

class CardapioItemController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $itens = CardapioItem::with('restaurante')
            ->where('restaurante_id', $restauranteId)
            ->orderBy('nome')
            ->paginate(12);

        return view('cardapio_itens.index', compact('itens'));
    }

    public function create()
    {
        return view('cardapio_itens.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'preco_venda' => ['required', 'numeric'],
            'tempo_preparo_minutos' => ['nullable', 'integer', 'min:0'],
            'complexidade_preparo' => ['required', 'integer', 'min:1', 'max:10'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'ativo_online' => ['nullable', 'boolean'],
        ]);

        $data['restaurante_id'] = $this->restauranteId();
        $data['ativo_online'] = $request->boolean('ativo_online');

        CardapioItem::create($data);

        return redirect()->route('cardapio-itens.index')->with('success', 'Item de cardápio cadastrado com sucesso.');
    }

    public function edit(CardapioItem $cardapioItem)
    {
        $this->authorizeItem($cardapioItem);

        return view('cardapio_itens.edit', ['item' => $cardapioItem]);
    }

    public function update(Request $request, CardapioItem $cardapioItem)
    {
        $this->authorizeItem($cardapioItem);

        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'preco_venda' => ['required', 'numeric'],
            'tempo_preparo_minutos' => ['nullable', 'integer', 'min:0'],
            'complexidade_preparo' => ['required', 'integer', 'min:1', 'max:10'],
            'categoria' => ['nullable', 'string', 'max:100'],
            'ativo_online' => ['nullable', 'boolean'],
        ]);

        $data['ativo_online'] = $request->boolean('ativo_online');

        $cardapioItem->update($data);

        return redirect()->route('cardapio-itens.index')->with('success', 'Item de cardápio atualizado com sucesso.');
    }

    public function destroy(CardapioItem $cardapioItem)
    {
        $this->authorizeItem($cardapioItem);

        $cardapioItem->delete();

        return redirect()->route('cardapio-itens.index')->with('success', 'Item de cardápio removido com sucesso.');
    }

    protected function restauranteId(): int
    {
        return (int) session('restaurante_id');
    }

    protected function authorizeItem(CardapioItem $cardapioItem): void
    {
        abort_unless($cardapioItem->restaurante_id === $this->restauranteId(), 403);
    }
}

