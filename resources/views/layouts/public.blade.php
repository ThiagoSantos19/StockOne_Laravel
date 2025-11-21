<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Cardápio') • StockOne</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900">
        <div class="min-h-screen">
            <header class="bg-white/90 shadow-sm backdrop-blur">
                <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-red-600">StockOne</p>
                        <h1 class="text-2xl font-semibold text-gray-900">@yield('title', 'Cardápio digital')</h1>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-sm font-medium text-gray-500">Powered by StockOne</span>
                        <a href="{{ route('auth.login') }}" class="text-xs font-semibold uppercase tracking-[0.3em] text-red-500 hover:text-red-600">Área do restaurante</a>
                    </div>
                </div>
            </header>

            <main class="px-4 py-10 sm:px-6">
                <div class="mx-auto max-w-6xl space-y-6">
                    @if (session('success'))
                        <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
                            <p class="font-semibold">Ops! Confira os campos:</p>
                            <ul class="mt-2 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            <footer class="border-t border-gray-100 bg-white/80">
                <div class="mx-auto flex max-w-6xl flex-col gap-2 px-6 py-6 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between">
                    <p>&copy; {{ date('Y') }} StockOne • Experiência digital para restaurantes</p>
                    <p class="text-xs uppercase tracking-[0.3em] text-red-500">Sabor com tecnologia</p>
                </div>
            </footer>
        </div>
    </body>
</html>


