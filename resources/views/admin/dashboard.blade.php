@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Painel de Administração</h1>
            <p class="text-sm text-zinc-500 mt-2">Resumo rápido das principais métricas da sua loja.</p>
        </div>
        <div class="rounded-3xl border border-zinc-200 bg-white px-5 py-4 shadow-sm">
            <span class="text-sm text-zinc-500">Olá,</span>
            <p class="text-xl font-semibold text-orange-600">{{ Auth::user()->nome }}</p>
        </div>
    </div>

    

    <div class="grid grid-cols-1 xl:grid-cols-[0.7fr_0.3fr] gap-6">
        <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-zinc-900">Ações rápidas</h2>
                    <p class="text-sm text-zinc-500 mt-1">Navegue direto para o que você mais usa no painel.</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <a href="{{ route('admin.produtos') }}" class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                    <p class="text-sm text-zinc-600">Gerenciar estampas</p>
                    <p class="mt-2 font-semibold text-zinc-900">Produtos</p>
                </a>
                <a href="{{ route('admin.pedidos') }}" class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                    <p class="text-sm text-zinc-600">Ver todos os pedidos</p>
                    <p class="mt-2 font-semibold text-zinc-900">Pedidos</p>
                </a>
                <a href="{{ route('admin.compras') }}" class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                    <p class="text-sm text-zinc-600">Acompanhar compras</p>
                    <p class="mt-2 font-semibold text-zinc-900">Compras</p>
                </a>
                <a href="{{ route('admin.mensagens') }}" class="rounded-3xl border border-zinc-200 bg-zinc-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                    <p class="text-sm text-zinc-600">Responder clientes</p>
                    <p class="mt-2 font-semibold text-zinc-900">Mensagens</p>
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-zinc-900 mb-4">Resumo rápido</h2>
            <ul class="space-y-4 text-sm text-zinc-600">
                <li class="flex items-center justify-between gap-4 rounded-3xl bg-zinc-50 px-4 py-4">
                    <span>Total de pedidos</span>
                    <strong class="text-zinc-900">{{ $total_pedidos }}</strong>
                </li>
                <li class="flex items-center justify-between gap-4 rounded-3xl bg-zinc-50 px-4 py-4">
                    <span>Total de compras</span>
                    <strong class="text-zinc-900">{{ $total_compras }}</strong>
                </li>
                <li class="flex items-center justify-between gap-4 rounded-3xl bg-zinc-50 px-4 py-4">
                    <span>Receita</span>
                    <strong class="text-orange-600">€ {{ number_format($total_vendido, 2, ',', '.') }}</strong>
                </li>
                <li class="flex items-center justify-between gap-4 rounded-3xl bg-zinc-50 px-4 py-4">
                    <span>Mensagens não lidas</span>
                    <strong class="text-zinc-900">{{ $mensagens_nao_lidas }}</strong>
                </li>
            </ul>
        </section>
    </div>
</div>
@endsection