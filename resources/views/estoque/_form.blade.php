@php
    $registro = $estoque ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Insumo *
            <select name="insumo_id" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Selecione...</option>
                @foreach ($insumos as $id => $nome)
                    <option value="{{ $id }}" @selected(old('insumo_id', $registro->insumo_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Quantidade atual *
            <input type="number" step="0.001" name="quantidade_atual" value="{{ old('quantidade_atual', $registro->quantidade_atual ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Localização
            <input type="text" name="localizacao" value="{{ old('localizacao', $registro->localizacao ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>
</div>

