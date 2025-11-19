@extends('layouts.app')

@section('title', 'Novo item de pedido')
@section('subtitle', 'Detalhe o que será produzido')

@section('content')
    <form action="{{ route('pedido-itens.store') }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf

        @include('pedido_itens._form', ['pedidoItem' => new \App\Models\PedidoItem()])

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('pedido-itens.index') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm text-gray-600 hover:text-red-600">
                Cancelar
            </a>
            <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                Salvar item
            </button>
        </div>
    </form>
@endsection

