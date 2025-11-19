@extends('layouts.app')

@section('title', 'Fila de produção')
@section('subtitle', 'Controle prioridades da cozinha')

@section('actions')
    <a href="{{ route('fila-producao.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Adicionar à fila
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Pedido</th>
                        <th class="px-6 py-3">Item</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Prioridade</th>
                        <th class="px-6 py-3">Atualização</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($filas as $registro)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-900">#{{ $registro->pedido_id }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $registro->pedidoItem?->cardapioItem?->nome ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-white px-3 py-1 text-xs font-semibold text-red-700 ring-1 ring-inset ring-red-200">
                                    {{ ucfirst($registro->status_producao) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $registro->prioridade ?? 0 }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $registro->updated_at?->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('fila-producao.edit', $registro) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">Editar</a>
                                    <form action="{{ route('fila-producao.destroy', $registro) }}" method="POST" data-confirm="Remover da fila?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Nenhum item na fila.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $filas->links() }}
        </div>
    </div>
@endsection

