@extends('layouts.app')

@section('title', 'Novo pedido')
@section('subtitle', 'Integre canais e pedidos em um só lugar')

@section('content')
    <form action="{{ route('pedidos.store') }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf

        @include('pedidos._form', ['pedido' => new \App\Models\Pedido()])

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('pedidos.index') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm text-gray-600 hover:text-red-600">
                Cancelar
            </a>
            <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                Salvar pedido
            </button>
        </div>
    </form>
@endsection

