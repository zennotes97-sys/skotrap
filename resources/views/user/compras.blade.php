@extends('layouts.app')

@section('title', 'Minhas Compras')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="flex items-center gap-3 mb-6">
        <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 shadow-sm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6" aria-hidden="true">
                <path d="M5 7.5h14l-1.1 9.7A2.3 2.3 0 0 1 15.6 19H8.4a2.3 2.3 0 0 1-2.3-1.8L5 7.5Z"/>
                <path d="M9 7.5V6.8A3 3 0 0 1 12 4a3 3 0 0 1 3 2.8v.7"/>
            </svg>
        </span>
        <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900">Minhas Compras</h2>
    </div>

    <div class="bg-neutral-900 text-white p-6 rounded-2xl shadow-xl border border-neutral-800 hover:border-orange-500/30 transition-all duration-300 mb-6">
        <h3 class="text-sm font-semibold tracking-wider text-neutral-400 uppercase mb-1">Total Gasto</h3>
        <p class="text-4xl font-black text-white">
            MZN {{ number_format($total_gasto, 2, ',', '.') }}
        </p>
        <p class="text-xs text-orange-400 mt-1 font-medium">
            <i class="fas fa-shopping-bag mr-1"></i> Baseado em {{ $compras->count() }} registo(s) no histórico
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200/80 overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-zinc-100 border-b border-zinc-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Produto</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Preço Unit.</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-zinc-600 uppercase tracking-wider">Quantidade</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Subtotal</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 tracking-wider">Data</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                @forelse ($compras as $compra)
                    @php
                        $produto = $compra->produto ?? 'Produto';
                        $quantidade = $compra->quantidade ?? 1;
                        $precoUnitario = $compra->preco ?? $compra->preco_unitario ?? $compra->valor_total ?? 0;
                        $subtotal = $compra->subtotal ?? $compra->valor_total ?? ($precoUnitario * $quantidade);
                        $dataCompra = $compra->data_compra ?? $compra->data_criacao ?? now();
                        $status = $compra->status ?? 'confirmada';
                    @endphp
                    <tr class="hover:bg-zinc-50/80 transition-colors duration-150 text-zinc-800">
                        <td class="px-6 py-4 font-medium text-zinc-900">{{ $produto }}</td>
                        <td class="px-6 py-4 text-zinc-600">MZN {{ number_format((float) $precoUnitario, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center font-medium text-zinc-700">{{ $quantidade }}</td>
                        <td class="px-6 py-4 font-semibold text-zinc-900">
                            MZN {{ number_format((float) $subtotal, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-zinc-700 capitalize">{{ $status }}</td>
                        <td class="px-6 py-4 text-zinc-500">
                            {{ \Carbon\Carbon::parse($dataCompra)->format('d/m/Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-zinc-500">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i class="fas fa-receipt text-3xl text-zinc-300"></i>
                                <p class="text-sm font-medium">Você ainda não tem histórico de compras.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (method_exists($compras, 'links'))
        <div class="mt-6">
            {{ $compras->links() }}
        </div>
    @endif
</div>
@endsection