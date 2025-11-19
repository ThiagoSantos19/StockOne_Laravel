@php
    $receita = $receita ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Item do cardápio *
            <select name="cardapio_item_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($cardapioItens as $id => $nome)
                    <option value="{{ $id }}" @selected(old('cardapio_item_id', $receita->cardapio_item_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Insumo *
            <select name="insumo_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($insumos as $id => $nome)
                    <option value="{{ $id }}" @selected(old('insumo_id', $receita->insumo_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Quantidade necessária *
            <input type="number" step="0.01" name="quantidade_necessaria" value="{{ old('quantidade_necessaria', $receita->quantidade_necessaria ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
        <input type="checkbox" name="essencial" value="1" @checked(old('essencial', $receita->essencial ?? true)) class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
        <span class="text-sm text-gray-700">Insumo essencial para produção</span>
    </div>
</div>

