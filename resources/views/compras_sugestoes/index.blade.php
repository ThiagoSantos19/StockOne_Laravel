@extends('layouts.app')

@section('title', 'Sugestões de compra')
@section('subtitle', 'Planeje o reabastecimento com inteligência')

@section('actions')
    <a href="{{ route('compras-sugestoes.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Nova sugestão
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Insumo</th>
                        <th class="px-6 py-3">Quantidade</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Data</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($sugestoes as $sugestao)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $sugestao->insumo?->nome ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $sugestao->quantidade_sugerida }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-white px-3 py-1 text-xs font-semibold text-red-700 ring-1 ring-inset ring-red-200">
                                    {{ ucfirst($sugestao->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $sugestao->data_geracao?->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('compras-sugestoes.edit', $sugestao) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">Editar</a>
                                    <form action="{{ route('compras-sugestoes.destroy', $sugestao) }}" method="POST" data-confirm="Remover esta sugestão?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Nenhuma sugestão gerada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $sugestoes->links() }}
        </div>
    </div>
@endsection

