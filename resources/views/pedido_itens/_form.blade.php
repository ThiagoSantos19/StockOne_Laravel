@php
    $pedidoItem = $pedidoItem ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Pedido *
            <select name="pedido_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($pedidos as $id => $label)
                    <option value="{{ $id }}" @selected(old('pedido_id', $pedidoItem->pedido_id ?? '') == $id)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Item do cardápio *
            <select name="cardapio_item_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($cardapioItens as $id => $nome)
                    <option value="{{ $id }}" @selected(old('cardapio_item_id', $pedidoItem->cardapio_item_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Quantidade *
            <input type="number" min="1" name="quantidade" value="{{ old('quantidade', $pedidoItem->quantidade ?? 1) }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Preço unitário (R$) *
            <input type="number" step="0.01" name="preco_unitario" value="{{ old('preco_unitario', $pedidoItem->preco_unitario ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Observações
            <textarea name="observacao" rows="3" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">{{ old('observacao', $pedidoItem->observacao ?? '') }}</textarea>
        </label>
    </div>
</div>

