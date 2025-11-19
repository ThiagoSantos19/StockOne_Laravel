@extends('layouts.app')

@section('title', 'Editar item de cardápio')
@section('subtitle', $item->nome)

@section('content')
    <form action="{{ route('cardapio-itens.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')

        @include('cardapio_itens._form')

        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('cardapio-itens.index') }}" class="text-sm text-gray-500 hover:text-red-600">&larr; Voltar</a>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    form="delete-item-cardapio"
                    class="rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-600 hover:bg-red-50"
                    data-confirm="Confirma excluir este item?"
                    data-confirm-trigger="true"
                    data-confirm-target="delete-item-cardapio"
                >
                    Excluir
                </button>
                <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                    Atualizar
                </button>
            </div>
        </div>
    </form>

    <form id="delete-item-cardapio" action="{{ route('cardapio-itens.destroy', $item) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

