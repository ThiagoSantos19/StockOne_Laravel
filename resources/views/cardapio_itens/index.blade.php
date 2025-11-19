@extends('layouts.app')

@section('title', 'Itens de cardápio')
@section('subtitle', 'Estruture o menu digital do restaurante')

@section('actions')
    <a href="{{ route('cardapio-itens.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Novo item
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Imagem</th>
                        <th class="px-6 py-3">Item</th>
                        <th class="px-6 py-3">Preço</th>
                        <th class="px-6 py-3">Categoria</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($itens as $item)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($item->imagem)
                                    <img src="{{ asset('storage/' . $item->imagem) }}" alt="{{ $item->nome }}" class="h-16 w-16 rounded-lg object-cover border border-gray-200">
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded-lg border border-gray-200 bg-gray-50 text-xs text-gray-400">
                                        Sem imagem
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->nome }}</td>
                            <td class="px-6 py-4 text-gray-600">R$ {{ number_format($item->preco_venda, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $item->categoria ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $item->ativo_online ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $item->ativo_online ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('cardapio-itens.edit', $item) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">
                                        Editar
                                    </a>
                                    <form action="{{ route('cardapio-itens.destroy', $item) }}" method="POST" data-confirm="Deseja remover este item?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Nenhum item cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $itens->links() }}
        </div>
    </div>
@endsection

