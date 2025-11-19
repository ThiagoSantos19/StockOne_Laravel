@extends('layouts.app')

@section('title', 'Pedidos')
@section('subtitle', 'Controle pedidos recebidos por canal')

@section('actions')
    <a href="{{ route('pedidos.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Novo pedido
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Pedido</th>
                        <th class="px-6 py-3">Restaurante</th>
                        <th class="px-6 py-3">Plataforma</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Valor</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">#{{ $pedido->id }} {{ $pedido->numero_pedido_externo ? '· ' . $pedido->numero_pedido_externo : '' }}</p>
                                <p class="text-xs text-gray-500">{{ $pedido->data_hora_pedido?->format('d/m/Y H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $pedido->restaurante?->nome ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $pedido->plataforma_origem }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    {{ ucfirst($pedido->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-900 font-semibold">
                                {{ $pedido->valor_total ? 'R$ ' . number_format($pedido->valor_total, 2, ',', '.') : '—' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('pedidos.edit', $pedido) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">Editar</a>
                                    <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" data-confirm="Deseja remover este pedido?">
                                        @csrf
                    @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Nenhum pedido registrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $pedidos->links() }}
        </div>
    </div>
@endsection

