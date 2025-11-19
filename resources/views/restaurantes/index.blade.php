@extends('layouts.app')

@section('title', 'Restaurantes')
@section('subtitle', 'Gerencie unidades e dados cadastrais')

@section('actions')
    <a href="{{ route('restaurantes.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Novo restaurante
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Nome</th>
                        <th class="px-6 py-3">CNPJ</th>
                        <th class="px-6 py-3">Contato</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($restaurantes as $restaurante)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $restaurante->nome }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $restaurante->cnpj ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700">{{ $restaurante->telefone ?? '—' }}</p>
                                <p class="text-xs text-gray-500">{{ $restaurante->email ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    {{ ucfirst($restaurante->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('restaurantes.edit', $restaurante) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">
                                        Editar
                                    </a>
                                    <form action="{{ route('restaurantes.destroy', $restaurante) }}" method="POST" data-confirm="Deseja remover este restaurante?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Nenhum restaurante cadastrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 px-6 py-4">
            {{ $restaurantes->links() }}
        </div>
    </div>
@endsection

