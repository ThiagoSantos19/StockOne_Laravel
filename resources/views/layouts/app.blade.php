<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>StockOne • @yield('title', 'Painel')</title>
        @if (app()->environment('testing'))
            <style>
                :root {
                    font-family: 'Instrument Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                }
            </style>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-gray-100 font-sans text-gray-900">
        <div class="min-h-screen flex">
            <aside class="w-64 bg-red-700 text-white flex flex-col">
                <div class="p-6">
                    <div class="text-2xl font-bold tracking-wide">StockOne</div>
                    <p class="text-sm text-red-100">Gestão inteligente para restaurantes</p>
                </div>

                <nav class="flex-1 px-4 space-y-1">
                    @php
                        $menu = [
                            ['label' => 'Dashboard', 'route' => 'dashboard'],
                            ['label' => 'Cardápio', 'route' => 'cardapio-itens.index'],
                            ['label' => 'Receitas', 'route' => 'receitas.index'],
                            ['label' => 'Insumos', 'route' => 'insumos.index'],
                            ['label' => 'Estoque', 'route' => 'estoque.index'],
                            ['label' => 'Pedidos', 'route' => 'pedidos.index'],
                            ['label' => 'Itens do pedido', 'route' => 'pedido-itens.index'],
                            ['label' => 'Fila de Produção', 'route' => 'fila-producao.index'],
                            ['label' => 'Alertas', 'route' => 'alertas.index'],
                            ['label' => 'Sugestões de Compras', 'route' => 'compras-sugestoes.index'],
                            ['label' => 'Menu', 'route' => 'public.menu'],
                        ];
                    @endphp

                    @foreach ($menu as $item)
                        @php
                            $active = request()->routeIs(str_replace('.index', '', $item['route']) . '*');
                        @endphp
                        <a
                            href="{{ route($item['route']) }}"
                            class="block rounded-lg px-4 py-2 text-sm font-medium transition
                                {{ $active ? 'bg-white text-red-700 shadow' : 'text-red-100 hover:bg-red-600 hover:text-white' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="p-4 text-xs text-red-100">
                    StockOne © {{ date('Y') }} · SaaS de restaurantes
                </div>
            </aside>

            <main class="flex-1 flex flex-col bg-white">
                <header class="border-b border-red-100 px-8 py-6 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-red-600">StockOne</p>
                        <h1 class="text-2xl font-semibold text-gray-900">@yield('title', 'Painel')</h1>
                        @hasSection('subtitle')
                            <p class="text-sm text-gray-500">@yield('subtitle')</p>
                        @endif
                    </div>

                    <div class="flex flex-wrap items-center justify-end gap-3">
                        @yield('actions')
                        <div class="flex items-center gap-3">
                            <div class="rounded-full border border-red-100 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">
                                {{ session('restaurante_nome') }}
                            </div>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-full border border-gray-200 px-5 py-2 text-sm font-semibold text-gray-600 transition hover:border-red-200 hover:text-red-600">
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <section class="flex-1 p-8 bg-gray-50">
                    @if (session('success'))
                        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            <p class="font-semibold">Ops! Verifique os campos:</p>
                            <ul class="list-inside list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </section>
            </main>
        </div>

        <div id="confirm-overlay" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 px-4">
            <div id="confirm-modal" class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl mx-auto lg:ml-64">
                <div class="mb-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-red-500">Confirmação</p>
                    <h2 class="mt-1 text-2xl font-semibold text-gray-900">Tem certeza?</h2>
                </div>
                <p id="confirm-message" class="text-sm text-gray-600" data-default="Esta ação é irreversível.">
                    Esta ação é irreversível.
                </p>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button id="confirm-cancel" type="button" class="rounded-full border border-gray-200 px-5 py-2 text-sm font-semibold text-gray-600 transition hover:border-red-200 hover:text-red-600">
                        Cancelar
                    </button>
                    <button id="confirm-accept" type="button" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow transition hover:bg-red-500">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const overlay = document.getElementById('confirm-overlay');
                const messageEl = document.getElementById('confirm-message');
                const confirmBtn = document.getElementById('confirm-accept');
                const cancelBtn = document.getElementById('confirm-cancel');
                let pendingForm = null;

                const closeModal = () => {
                    overlay.classList.add('hidden');
                    pendingForm = null;
                };

                const openModal = (message, form) => {
                    pendingForm = form;
                    messageEl.textContent = message || messageEl.dataset.default;
                    overlay.classList.remove('hidden');
                    confirmBtn.focus();
                };

                confirmBtn.addEventListener('click', () => {
                    if (pendingForm) {
                        pendingForm.dataset.confirmed = 'true';
                        pendingForm.submit();
                    }
                    closeModal();
                });

                cancelBtn.addEventListener('click', closeModal);
                overlay.addEventListener('click', (event) => {
                    if (event.target === overlay) {
                        closeModal();
                    }
                });

                document.querySelectorAll('form[data-confirm]').forEach((form) => {
                    form.addEventListener('submit', (event) => {
                        if (form.dataset.confirmed === 'true') {
                            form.dataset.confirmed = '';
                            return;
                        }

                        event.preventDefault();
                        openModal(form.dataset.confirm, form);
                    });
                });

                document.querySelectorAll('[data-confirm-trigger]').forEach((trigger) => {
                    trigger.addEventListener('click', (event) => {
                        event.preventDefault();
                        const targetId = trigger.dataset.confirmTarget || trigger.getAttribute('form');
                        const form = document.getElementById(targetId);
                        if (!form) {
                            console.warn('Formulário não encontrado para confirmação:', targetId);
                            return;
                        }

                        openModal(trigger.dataset.confirm || form.dataset.confirm, form);
                    });
                });
            });
        </script>
    </body>
</html>

