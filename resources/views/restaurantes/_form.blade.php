@php
    $restaurante = $restaurante ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm font-semibold text-gray-700">
            Nome *
            <input type="text" name="nome" value="{{ old('nome', $restaurante->nome ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500" required>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            CNPJ
            <input type="text" name="cnpj" value="{{ old('cnpj', $restaurante->cnpj ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Endereço
            <textarea name="endereco" rows="3" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">{{ old('endereco', $restaurante->endereco ?? '') }}</textarea>
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Telefone
            <input type="text" name="telefone" value="{{ old('telefone', $restaurante->telefone ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Email
            <input type="email" name="email" value="{{ old('email', $restaurante->email ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Status *
            <select name="status" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
                @foreach (['ativo', 'inativo'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $restaurante->status ?? 'ativo') === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </label>
    </div>
</div>

