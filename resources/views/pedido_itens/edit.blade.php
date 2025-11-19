@extends('layouts.app')

@section('title', 'Editar item de pedido')
@section('subtitle', '#'.$pedidoItem->pedido_id)

@section('content')
    <form action="{{ route('pedido-itens.update', $pedidoItem) }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')

        @include('pedido_itens._form')

        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('pedido-itens.index') }}" class="text-sm text-gray-500 hover:text-red-600">&larr; Voltar</a>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    form="delete-pedido-item"
                    class="rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-600 hover:bg-red-50"
                    data-confirm="Confirma excluir este item?"
                    data-confirm-trigger="true"
                    data-confirm-target="delete-pedido-item"
                >
                    Excluir
                </button>
                <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                    Atualizar
                </button>
            </div>
        </div>
    </form>

    <form id="delete-pedido-item" action="{{ route('pedido-itens.destroy', $pedidoItem) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

