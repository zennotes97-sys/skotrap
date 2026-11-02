@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Operações</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Pedidos</h1>
                <p class="mt-2 text-sm text-slate-600">Visualize e gerencie os pedidos realizados na sua loja.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
                <span class="text-sm text-slate-500">Pedidos realizados</span>
                <p class="mt-1 text-3xl font-extrabold text-orange-600">{{ $pedidos->count() }}</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">ID do Pedido</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Data</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $pedido->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ \Carbon\Carbon::parse($pedido->data_criacao)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ strtolower($pedido->status ?? '') === 'pendente' ? 'bg-amber-100 text-amber-800' : (strtolower($pedido->status ?? '') === 'concluido' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700') }}">
                                    {{ ucfirst($pedido->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800">€ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
 