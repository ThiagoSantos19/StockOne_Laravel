@php
    $fila = $fila ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Item do pedido *
            <select name="pedido_item_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($pedidoItens as $id => $label)
                    <option value="{{ $id }}" @selected(old('pedido_item_id', $fila->pedido_item_id ?? '') == $id)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <p class="mt-2 text-xs text-gray-500">Ao selecionar um item o pedido é vinculado automaticamente.</p>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Status da produção *
            <input type="text" name="status_producao" value="{{ old('status_producao', $fila->status_producao ?? 'pendente') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Prioridade
            <input type="number" name="prioridade" value="{{ old('prioridade', $fila->prioridade ?? 0) }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Início produção
            <input type="datetime-local" name="data_hora_inicio" value="{{ old('data_hora_inicio', isset($fila->data_hora_inicio) ? $fila->data_hora_inicio->format('Y-m-d\TH:i') : '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Fim produção
            <input type="datetime-local" name="data_hora_fim" value="{{ old('data_hora_fim', isset($fila->data_hora_fim) ? $fila->data_hora_fim->format('Y-m-d\TH:i') : '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>
</div>

