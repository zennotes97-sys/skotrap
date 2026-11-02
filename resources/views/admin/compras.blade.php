@extends('layouts.app')

@section('title', 'Compras')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Vendas</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Histórico de Compras</h1>
                <p class="mt-2 text-sm text-slate-600">Visualize todas as compras realizadas na plataforma.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
                <span class="text-sm text-slate-500">Total de compras</span>
                <p class="mt-1 text-3xl font-extrabold text-orange-600">{{ $compras->total() }}</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Cliente</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Produto</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Valor Total</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Data da Compra</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($compras as $compra)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $compra->nome_usuario }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $compra->produto }} (x{{ $compra->quantidade }})</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800">
                                € {{ number_format($compra->preco * $compra->quantidade, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-500">Nenhuma compra encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $compras->links() }}
        </div>
    </div>
</div>
@endsection