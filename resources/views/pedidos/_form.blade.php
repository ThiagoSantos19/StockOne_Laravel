@php
    $pedido = $pedido ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2 rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
        Operando em: <strong>{{ session('restaurante_nome') }}</strong>
    </div>
    <input type="hidden" name="restaurante_id" value="{{ session('restaurante_id') }}">

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Responsável
            <select name="usuario_id" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                <option value="">Não definido</option>
                @foreach ($usuarios as $id => $nome)
                    <option value="{{ $id }}" @selected(old('usuario_id', $pedido->usuario_id ?? '') == $id)>{{ $nome }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Nº pedido externo
            <input type="text" name="numero_pedido_externo" value="{{ old('numero_pedido_externo', $pedido->numero_pedido_externo ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Plataforma de origem *
            <input type="text" name="plataforma_origem" value="{{ old('plataforma_origem', $pedido->plataforma_origem ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Data e hora do pedido *
            <input type="datetime-local" name="data_hora_pedido" value="{{ old('data_hora_pedido', isset($pedido->data_hora_pedido) ? $pedido->data_hora_pedido->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Status *
            <input type="text" name="status" value="{{ old('status', $pedido->status ?? 'recebido') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Valor total (R$)
            <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total', $pedido->valor_total ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Tempo estimado (min)
            <input type="number" name="tempo_preparo_estimado" value="{{ old('tempo_preparo_estimado', $pedido->tempo_preparo_estimado ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>
</div>

