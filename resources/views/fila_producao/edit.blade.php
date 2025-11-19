@extends('layouts.app')

@section('title', 'Editar fila de produção')
@section('subtitle', 'Pedido #'.$fila->pedido_id)

@section('content')
    <form action="{{ route('fila-producao.update', $fila) }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')

        @include('fila_producao._form')

        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('fila-producao.index') }}" class="text-sm text-gray-500 hover:text-red-600">&larr; Voltar</a>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    form="delete-fila"
                    class="rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-600 hover:bg-red-50"
                    data-confirm="Confirma remover este item da fila?"
                    data-confirm-trigger="true"
                    data-confirm-target="delete-fila"
                >
                    Remover
                </button>
                <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                    Atualizar
                </button>
            </div>
        </div>
    </form>

    <form id="delete-fila" action="{{ route('fila-producao.destroy', $fila) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

