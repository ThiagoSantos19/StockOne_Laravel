@php
    $insumo = $insumo ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2 rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
        Operando em: <strong>{{ session('restaurante_nome') }}</strong>
    </div>
    <input type="hidden" name="restaurante_id" value="{{ session('restaurante_id') }}">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Nome *
            <input type="text" name="nome" value="{{ old('nome', $insumo->nome ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Categoria
            <input type="text" name="categoria" value="{{ old('categoria', $insumo->categoria ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Unidade de medida *
            <input type="text" name="unidade_medida" value="{{ old('unidade_medida', $insumo->unidade_medida ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Ponto de reposição mínimo
            <input type="number" step="0.01" name="ponto_reposicao_minimo" value="{{ old('ponto_reposicao_minimo', $insumo->ponto_reposicao_minimo ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Custo unitário (R$)
            <input type="number" step="0.01" name="custo_unitario" value="{{ old('custo_unitario', $insumo->custo_unitario ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Data de validade mínima
            <input type="date" name="data_validade_minima" value="{{ old('data_validade_minima', isset($insumo->data_validade_minima) ? $insumo->data_validade_minima->format('Y-m-d') : '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Descrição
            <textarea name="descricao" rows="3" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">{{ old('descricao', $insumo->descricao ?? '') }}</textarea>
        </label>
    </div>
</div>

