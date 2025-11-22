@extends('layouts.app')

@section('title', 'Pedidos')


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
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    {{ \Illuminate\Support\Str::lower($pedido->status) === 'concluido' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($pedido->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-900 font-semibold">
                                {{ $pedido->valor_total ? 'R$ ' . number_format($pedido->valor_total, 2, ',', '.') : '—' }}
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

