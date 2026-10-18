@extends('layouts.app')

@section('title', 'Minhas Compras')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-extrabold tracking-tight mb-6 text-neutral-900">Minhas Compras</h2>

    <div class="bg-neutral-900 text-white p-6 rounded-2xl shadow-xl border border-neutral-800 hover:border-orange-500/30 transition-all duration-300 mb-6">
        <h3 class="text-sm font-semibold tracking-wider text-neutral-400 uppercase mb-1">Total Gasto</h3>
        <p class="text-4xl font-black text-white">
            € {{ number_format($total_gasto, 2, ',', '.') }}
        </p>
        <p class="text-xs text-orange-400 mt-1 font-medium">
            <i class="fas fa-shopping-bag mr-1"></i> Baseado em {{ $compras->total() }} compra(s) registrada(s)
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200/80 overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-zinc-100 border-b border-zinc-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Produto</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Preço</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-zinc-600 uppercase tracking-wider">Quantidade</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Subtotal</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 tracking-wider">Data</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 text-sm">
                @forelse ($compras as $compra)
                    <tr class="hover:bg-zinc-50/80 transition-colors duration-150 text-zinc-800">
                        <td class="px-6 py-4 font-medium text-zinc-900">{{ $compra->produto }}</td>
                        <td class="px-6 py-4 text-zinc-600">€ {{ number_format($compra->preco, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center font-medium text-zinc-700">{{ $compra->quantidade }}</td>
                        <td class="px-6 py-4 font-semibold text-zinc-900">
                            {{-- Se o banco não tiver a coluna subtotal, calculamos na hora: --}}
                            € {{ number_format($compra->preco * $compra->quantidade, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-zinc-500">
                            {{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-zinc-500">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i class="fas fa-receipt text-3xl text-zinc-300"></i>
                                <p class="text-sm font-medium">Você ainda não fez nenhuma compra.</p>
                            </div>
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