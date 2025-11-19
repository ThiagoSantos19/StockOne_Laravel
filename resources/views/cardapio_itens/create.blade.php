@extends('layouts.app')

@section('title', 'Novo item de cardápio')
@section('subtitle', 'Configure produtos e pratos do restaurante')

@section('content')
    <form action="{{ route('cardapio-itens.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf

        @include('cardapio_itens._form', ['item' => new \App\Models\CardapioItem()])

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('cardapio-itens.index') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm text-gray-600 hover:text-red-600">
                Cancelar
            </a>
            <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                Salvar item
            </button>
        </div>
    </form>
@endsection

