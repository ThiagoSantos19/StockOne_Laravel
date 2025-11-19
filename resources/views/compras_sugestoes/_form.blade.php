@php
    $sugestao = $sugestao ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Insumo *
            <select name="insumo_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($insumos as $id => $nome)
                    <option value="{{ $id }}" @selected(old('insumo_id', $sugestao->insumo_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Quantidade sugerida *
            <input type="number" step="0.001" name="quantidade_sugerida" value="{{ old('quantidade_sugerida', $sugestao->quantidade_sugerida ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Status *
            <input type="text" name="status" value="{{ old('status', $sugestao->status ?? 'pendente') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Período analisado (dias)
            <input type="number" name="periodo_analise_dias" value="{{ old('periodo_analise_dias', $sugestao->periodo_analise_dias ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Data de geração *
            <input type="date" name="data_geracao" value="{{ old('data_geracao', isset($sugestao->data_geracao) ? $sugestao->data_geracao->format('Y-m-d') : now()->format('Y-m-d')) }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Justificativa
            <textarea name="justificativa" rows="3" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">{{ old('justificativa', $sugestao->justificativa ?? '') }}</textarea>
        </label>
    </div>
</div>

