@extends('layouts.app')

@section('title', 'Adicionar à fila')
@section('subtitle', 'Controle da produção em tempo real')

@section('content')
    <form action="{{ route('fila-producao.store') }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf

        @include('fila_producao._form', ['fila' => new \App\Models\FilaProducao()])

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('fila-producao.index') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm text-gray-600 hover:text-red-600">
                Cancelar
            </a>
            <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                Enviar para fila
            </button>
        </div>
    </form>
@endsection

