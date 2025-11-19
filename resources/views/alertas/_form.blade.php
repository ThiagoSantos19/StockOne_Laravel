@php
    $alerta = $alerta ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Insumo *
            <select name="insumo_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($insumos as $id => $nome)
                    <option value="{{ $id }}" @selected(old('insumo_id', $alerta->insumo_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Tipo de alerta *
            <input type="text" name="tipo_alerta" value="{{ old('tipo_alerta', $alerta->tipo_alerta ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Mensagem *
            <textarea name="mensagem" rows="3" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">{{ old('mensagem', $alerta->mensagem ?? '') }}</textarea>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Data e hora
            <input type="datetime-local" name="data_hora_alerta" value="{{ old('data_hora_alerta', isset($alerta->data_hora_alerta) ? $alerta->data_hora_alerta->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="flex items-center gap-4 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
        <label class="flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="visualizado" value="1" @checked(old('visualizado', $alerta->visualizado ?? false)) class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
            Visualizado
        </label>
        <label class="flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="resolvido" value="1" @checked(old('resolvido', $alerta->resolvido ?? false)) class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
            Resolvido
        </label>
    </div>
</div>

