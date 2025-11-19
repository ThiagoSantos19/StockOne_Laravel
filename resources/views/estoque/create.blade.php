@extends('layouts.app')

@section('title', 'Registrar estoque')
@section('subtitle', 'Vincule quantidade ao insumo')

@section('content')
    <form action="{{ route('estoque.store') }}" method="POST" class="space-y-6 rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
        @csrf

        @include('estoque._form', ['estoque' => new \App\Models\Estoque()])

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('estoque.index') }}" class="rounded-full border border-gray-200 px-5 py-2 text-sm text-gray-600 hover:text-red-600">
                Cancelar
            </a>
            <button type="submit" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
                Salvar
            </button>
        </div>
    </form>
@endsection

