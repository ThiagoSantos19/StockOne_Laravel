@extends('layouts.app')

@section('title', 'Alertas operacionais')
@section('subtitle', 'Priorize ações críticas do estoque')

@section('actions')
    <a href="{{ route('alertas.create') }}" class="rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-red-500">
        Novo alerta
    </a>
@endsection

@section('content')
    <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-red-50 text-left text-xs font-semibold uppercase tracking-wide text-red-600">
                    <tr>
                        <th class="px-6 py-3">Insumo</th>
                        <th class="px-6 py-3">Tipo</th>
                        <th class="px-6 py-3">Mensagem</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($alertas as $alerta)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $alerta->insumo?->nome ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $alerta->tipo_alerta }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ \Illuminate\Support\Str::limit($alerta->mensagem, 60) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $alerta->visualizado ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $alerta->visualizado ? 'Visualizado' : 'Pendente' }}
                                    </span>
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $alerta->resolvido ? 'bg-gray-100 text-gray-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $alerta->resolvido ? 'Resolvido' : 'Aberto' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('alertas.edit', $alerta) }}" class="text-sm font-semibold text-red-600 hover:text-red-800">Editar</a>
                                    <form action="{{ route('alertas.destroy', $alerta) }}" method="POST" data-confirm="Remover este alerta?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-500 hover:text-red-700">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Nenhum alerta ativo.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $alertas->links() }}
        </div>
    </div>
@endsection

