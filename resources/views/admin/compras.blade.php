@extends('layouts.app')

@section('title', 'Compras')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Histórico de Compras</h1>
            <p class="text-sm text-zinc-500 mt-2">Visualize todas as compras realizadas na plataforma.</p>
        </div>
        <div>
            <span class="text-sm text-zinc-500">Total de compras</span>
            <p class="text-3xl font-semibold text-orange-500 mt-1">{{ $compras->total() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-zinc-200">
            <thead class="bg-zinc-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Cliente</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Produto</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Valor Total</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Data da Compra</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-zinc-200">
                @forelse($compras as $compra)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900">{{ $compra->nome_usuario }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">{{ $compra->produto }} (x{{ $compra->quantidade }})</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-zinc-800">
                            € {{ number_format($compra->preco * $compra->quantidade, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-zinc-500">
                            Nenhuma compra encontrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $compras->links() }}
    </div>
</div>
@endsection