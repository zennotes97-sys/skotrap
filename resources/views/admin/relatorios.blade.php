@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Relatórios</h1>
            <p class="text-sm text-zinc-500 mt-2">Analise o desempenho da sua loja com relatórios detalhados.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        
        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:border-orange-300 hover:bg-orange-50">
            <h2 class="text-lg font-semibold text-zinc-900">Vendas por Período</h2>
            <p class="text-sm text-zinc-500 mt-1 mb-4">Filtre as vendas por dia, semana, mês ou ano.</p>
            <a href="#" class="font-semibold text-orange-600 text-sm">Gerar Relatório →</a>
        </div>

        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:border-orange-300 hover:bg-orange-50">
            <h2 class="text-lg font-semibold text-zinc-900">Produtos Mais Vendidos</h2>
            <p class="text-sm text-zinc-500 mt-1 mb-4">Veja quais estampas e produtos são mais populares.</p>
            <a href="#" class="font-semibold text-orange-600 text-sm">Ver Ranking →</a>
        </div>

        <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm transition hover:border-orange-300 hover:bg-orange-50">
            <h2 class="text-lg font-semibold text-zinc-900">Relatório de Clientes</h2>
            <p class="text-sm text-zinc-500 mt-1 mb-4">Analise o comportamento de compra dos seus clientes.</p>
            <a href="#" class="font-semibold text-orange-600 text-sm">Analisar Clientes →</a>
        </div>

    </div>
</div>
@endsection