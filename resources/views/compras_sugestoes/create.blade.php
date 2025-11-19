@extends('layouts.app')

@section('title', 'Nova sugestão de compra')
@section('subtitle', 'Antecipe rupturas de estoque')

@section('content')
    <form action="{{ route('compras-sugestoes.store') }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf

        @include('compras_sugestoes._form', ['sugestao' => new \App\Models\CompraSugestao()])

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('compras-sugestoes.index') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm text-gray-600 hover:text-red-600">
                Cancelar
            </a>
            <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                Salvar sugestão
            </button>
        </div>
    </form>
@endsection

