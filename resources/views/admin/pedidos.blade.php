@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Pedidos</h1>
            <p class="text-sm text-zinc-500 mt-2">Visualize e gerencie os pedidos realizados na sua loja.</p>
        </div>
        <div>
            <span class="text-sm text-zinc-500">Pedidos realizados</span>
            <p class="text-3xl font-semibold text-orange-500 mt-1">{{ $pedidos->count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-zinc-200">
            <thead class="bg-zinc-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">ID do Pedido</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Data</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-zinc-200">
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pedido->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($pedido->data_criacao)->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($pedido->status) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">€ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
 