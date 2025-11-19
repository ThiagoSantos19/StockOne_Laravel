@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Visão geral do StockOne')

@php
    use App\Models\CardapioItem;
    use App\Models\Insumo;
    use App\Models\Pedido;
    use App\Models\Alerta;

    $restauranteId = session('restaurante_id');

    $metrics = [
        [
            'label' => 'Itens de cardápio',
            'value' => CardapioItem::where('restaurante_id', $restauranteId)->count(),
            'route' => 'cardapio-itens.index',
        ],
        [
            'label' => 'Insumos cadastrados',
            'value' => Insumo::where('restaurante_id', $restauranteId)->count(),
            'route' => 'insumos.index',
        ],
        [
            'label' => 'Pedidos registrados',
            'value' => Pedido::where('restaurante_id', $restauranteId)->count(),
            'route' => 'pedidos.index',
        ],
        [
            'label' => 'Alertas abertos',
            'value' => Alerta::where('resolvido', false)
                ->whereHas('insumo', fn ($query) => $query->where('restaurante_id', $restauranteId))
                ->count(),
            'route' => 'alertas.index',
        ],
    ];
@endphp

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($metrics as $metric)
            <a href="{{ route($metric['route']) }}" class="block rounded-2xl border border-red-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <p class="text-sm uppercase tracking-wide text-red-500">{{ $metric['label'] }}</p>
                <p class="mt-3 text-4xl font-bold text-gray-900">{{ $metric['value'] }}</p>
                <p class="mt-2 text-sm text-gray-500">ver detalhes</p>
            </a>
        @endforeach
    </div>

    <div class="mt-10 grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">Fluxos críticos</h2>
            <p class="mt-1 text-sm text-gray-500">Atalhos para fluxos mais usados no StockOne</p>

            <div class="mt-5 space-y-4">
                <a href="{{ route('pedidos.create') }}" class="flex items-center justify-between rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 hover:bg-white">
                    Registrar pedido
                    <span>&rarr;</span>
                </a>
                <a href="{{ route('insumos.create') }}" class="flex items-center justify-between rounded-xl border border-gray-100 px-4 py-3 text-sm font-medium text-gray-700 hover:border-red-200 hover:text-red-600">
                    Cadastrar insumo
                    <span>&rarr;</span>
                </a>
                <a href="{{ route('estoque.index') }}" class="flex items-center justify-between rounded-xl border border-gray-100 px-4 py-3 text-sm font-medium text-gray-700 hover:border-red-200 hover:text-red-600">
                    Monitorar estoque
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">Próximos passos no seu restaurante</h2>
            <p class="mt-1 text-sm text-gray-500">Centralize operações diárias em poucos cliques.</p>

            <ul class="mt-4 space-y-3 text-sm text-gray-600">
                <li class="flex gap-2">
                    <span class="font-semibold text-red-600">1.</span>
                    Mantenha o cardápio alinhado com a cozinha cadastrando itens e receitas.
                </li>
                <li class="flex gap-2">
                    <span class="font-semibold text-red-600">2.</span>
                    Registre pedidos, acompanhe a produção e finalize entregas.
                </li>
                <li class="flex gap-2">
                    <span class="font-semibold text-red-600">3.</span>
                    Monitore estoque e alertas para antecipar compras e evitar rupturas.
                </li>
            </ul>
        </div>
    </div>
@endsection

