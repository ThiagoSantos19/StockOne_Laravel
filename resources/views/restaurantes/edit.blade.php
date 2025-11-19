@extends('layouts.app')

@section('title', 'Editar restaurante')
@section('subtitle', $restaurante->nome)

@section('content')
    <form action="{{ route('restaurantes.update', $restaurante) }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')

        @include('restaurantes._form')

        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('restaurantes.index') }}" class="text-sm text-gray-500 hover:text-red-600">&larr; Voltar</a>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    form="delete-restaurante"
                    class="rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-600 hover:bg-red-50"
                    data-confirm="Confirma excluir este restaurante?"
                    data-confirm-trigger="true"
                    data-confirm-target="delete-restaurante"
                >
                    Excluir
                </button>
                <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                    Atualizar
                </button>
            </div>
        </div>
    </form>

    <form id="delete-restaurante" action="{{ route('restaurantes.destroy', $restaurante) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

