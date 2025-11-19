<?php

namespace App\Http\Controllers;

use App\Models\FilaProducao;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
class FilaProducaoController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $filas = FilaProducao::with(['pedidoItem.cardapioItem', 'pedido'])
            ->whereHas('pedido', fn ($query) => $query->where('restaurante_id', $restauranteId))
            ->orderBy('prioridade', 'desc')
            ->orderBy('created_at')
            ->paginate(15);

        return view('fila_producao.index', compact('filas'));
    }

    public function create()
    {
        $pedidoItens = $this->pedidoItensDisponiveis();

        return view('fila_producao.create', compact('pedidoItens'));
    }

    public function store(Request $request)
    {
        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'pedido_item_id' => ['required', 'exists:pedido_itens,id'],
            'status_producao' => ['required', 'string', 'max:50'],
            'prioridade' => ['nullable', 'integer'],
            'data_hora_inicio' => ['nullable', 'date'],
            'data_hora_fim' => ['nullable', 'date', 'after_or_equal:data_hora_inicio'],
        ]);

        $pedidoItem = PedidoItem::with('pedido')->findOrFail($data['pedido_item_id']);
        abort_unless($pedidoItem->pedido?->restaurante_id === $restauranteId, 403);

        $data['pedido_id'] = $pedidoItem->pedido_id;

        FilaProducao::create($data);

        return redirect()->route('fila-producao.index')->with('success', 'Item enviado para a fila de produção.');
    }

    public function edit(FilaProducao $filaProducao)
    {
        $this->authorizeFila($filaProducao);

        $pedidoItens = $this->pedidoItensDisponiveis();

        return view('fila_producao.edit', [
            'fila' => $filaProducao,
            'pedidoItens' => $pedidoItens,
        ]);
    }

    public function update(Request $request, FilaProducao $filaProducao)
    {
        $this->authorizeFila($filaProducao);

        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'pedido_item_id' => ['required', 'exists:pedido_itens,id'],
            'status_producao' => ['required', 'string', 'max:50'],
            'prioridade' => ['nullable', 'integer'],
            'data_hora_inicio' => ['nullable', 'date'],
            'data_hora_fim' => ['nullable', 'date', 'after_or_equal:data_hora_inicio'],
        ]);

        $pedidoItem = PedidoItem::with('pedido')->findOrFail($data['pedido_item_id']);
        abort_unless($pedidoItem->pedido?->restaurante_id === $restauranteId, 403);

        $data['pedido_id'] = $pedidoItem->pedido_id;

        $filaProducao->update($data);

        return redirect()->route('fila-producao.index')->with('success', 'Fila de produção atualizada com sucesso.');
    }

    public function destroy(FilaProducao $filaProducao)
    {
        $this->authorizeFila($filaProducao);

        $filaProducao->delete();

        return redirect()->route('fila-producao.index')->with('success', 'Item removido da fila.');
    }

    protected function authorizeFila(FilaProducao $filaProducao): void
    {
        abort_unless($filaProducao->pedido?->restaurante_id === $this->restauranteId(), 403);
    }

    protected function pedidoItensDisponiveis()
    {
        $restauranteId = $this->restauranteId();

        return PedidoItem::with(['pedido', 'cardapioItem'])
            ->whereHas('pedido', fn ($query) => $query->where('restaurante_id', $restauranteId))
            ->orderByDesc('created_at')
            ->get()
            ->mapWithKeys(function ($item) {
                $pedidoNumero = $item->pedido?->numero_pedido_externo ?? $item->pedido_id;
                $label = sprintf('#%s - %s', $pedidoNumero, $item->cardapioItem?->nome ?? 'Item');

                return [$item->id => $label];
            });
    }
}
