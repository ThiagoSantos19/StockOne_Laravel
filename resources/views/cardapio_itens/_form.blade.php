@php
    $item = $item ?? null;
@endphp

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2 rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
        Operando em: <strong>{{ session('restaurante_nome') }}</strong>
    </div>
    <input type="hidden" name="restaurante_id" value="{{ session('restaurante_id') }}">

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Nome *
            <input type="text" name="nome" value="{{ old('nome', $item->nome ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Preço de venda (R$) *
            <input type="number" step="0.01" name="preco_venda" value="{{ old('preco_venda', $item->preco_venda ?? '') }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Tempo de preparo (min)
            <input type="number" name="tempo_preparo_minutos" value="{{ old('tempo_preparo_minutos', $item->tempo_preparo_minutos ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Complexidade (1-10) *
            <input type="number" min="1" max="10" name="complexidade_preparo" value="{{ old('complexidade_preparo', $item->complexidade_preparo ?? 1) }}" required class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div>
        <label class="text-sm font-semibold text-gray-700">
            Categoria
            <input type="text" name="categoria" value="{{ old('categoria', $item->categoria ?? '') }}" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Imagem do item
            <input type="file" name="imagem" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-red-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-red-700 hover:file:bg-red-100 focus:border-red-500 focus:ring-red-500">
        </label>
        @if (isset($item) && $item->imagem)
            <div class="mt-3">
                <p class="mb-2 text-xs text-gray-500">Imagem atual:</p>
                <img src="{{ asset('storage/' . $item->imagem) }}" alt="{{ $item->nome }}" class="h-32 w-32 rounded-xl object-cover border border-gray-200">
            </div>
        @endif
        <p class="mt-1 text-xs text-gray-500">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP (máx. 2MB)</p>
    </div>

    <div class="md:col-span-2 flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
        <input type="checkbox" name="ativo_online" value="1" @checked(old('ativo_online', $item->ativo_online ?? true)) class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
        <span class="text-sm text-gray-700">Disponível nos canais online</span>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-semibold text-gray-700">
            Descrição
            <textarea name="descricao" rows="3" class="mt-1 w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm focus:border-red-500 focus:ring-red-500">{{ old('descricao', $item->descricao ?? '') }}</textarea>
        </label>
    </div>
</div>

