@extends('layouts.app')

@section('title', 'Receitas e composição')
@section('subtitle', 'Vincule insumos aos itens do cardápio')

@section('actions')
    <a href="{{ route('receitas.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Nova receita
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Item</th>
                        <th class="px-6 py-3">Insumo</th>
                        <th class="px-6 py-3">Quantidade</th>
                        <th class="px-6 py-3">Essencial</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($receitas as $receita)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $receita->cardapioItem?->nome ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $receita->insumo?->nome ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $receita->quantidade_necessaria }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $receita->essencial ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $receita->essencial ? 'Sim' : 'Não' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('receitas.edit', $receita) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">Editar</a>
                                    <form action="{{ route('receitas.destroy', $receita) }}" method="POST" data-confirm="Remover esta receita?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Nenhuma receita cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $receitas->links() }}
        </div>
    </div>
@endsection

