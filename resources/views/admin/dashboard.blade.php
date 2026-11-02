@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Administração</p>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Painel de Administração</h1>
                    <p class="mt-2 text-sm text-slate-600">Resumo rápido das principais métricas da sua loja.</p>
                </div>

                <div class="rounded-2xl border border-orange-200 bg-orange-50 px-4 py-3">
                    <span class="text-xs font-medium uppercase tracking-[0.18em] text-orange-700">Olá</span>
                    <p class="mt-1 text-lg font-bold text-orange-700">{{ Auth::user()->nome }}</p>
                </div>
            </div>
        </div>

        <div class="mb-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-500">Pedidos</span>
                    <span class="rounded-xl bg-orange-100 p-2 text-orange-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 7.5h18L18 19H6L3 7.5Z"/><path d="M8 7V5.8A4 4 0 0 1 12 2a4 4 0 0 1 4 3.8V7"/></svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-900">{{ $total_pedidos }}</p>
                <p class="mt-1 text-xs text-slate-500">No total</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-500">Compras</span>
                    <span class="rounded-xl bg-emerald-100 p-2 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 9h16l-1.5 9h-13L4 9Z"/><path d="M8 9V7a4 4 0 0 1 8 0v2"/></svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-900">{{ $total_compras }}</p>
                <p class="mt-1 text-xs text-slate-500">Registradas</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-500">Receita</span>
                    <span class="rounded-xl bg-yellow-100 p-2 text-yellow-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 1v22"/><path d="M17 5H9.5A3.5 3.5 0 0 0 6 8.5 3.5 3.5 0 0 0 9.5 12H14.5A3.5 3.5 0 0 1 18 15.5 3.5 3.5 0 0 1 14.5 19H6"/></svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-orange-600">€ {{ number_format($total_vendido, 2, ',', '.') }}</p>
                <p class="mt-1 text-xs text-slate-500">Valor total</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-500">Mensagens</span>
                    <span class="rounded-xl bg-sky-100 p-2 text-sky-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 19V7.5A2.5 2.5 0 0 1 7.5 5h9A2.5 2.5 0 0 1 19 7.5v7A2.5 2.5 0 0 1 16.5 17H9l-4 2Z"/><path d="M8 9h8M8 12h5"/></svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-slate-900">{{ $mensagens_nao_lidas }}</p>
                <p class="mt-1 text-xs text-slate-500">Não lidas</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[0.7fr_0.3fr]">
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Ações rápidas</h2>
                        <p class="mt-1 text-sm text-slate-500">Navegue direto para o que mais usa no painel.</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('admin.produtos') }}" class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                        <p class="text-sm text-slate-600">Gerenciar estampas</p>
                        <p class="mt-2 text-lg font-bold text-slate-900">Produtos</p>
                    </a>
                    <a href="{{ route('admin.pedidos') }}" class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                        <p class="text-sm text-slate-600">Ver todos os pedidos</p>
                        <p class="mt-2 text-lg font-bold text-slate-900">Pedidos</p>
                    </a>
                    <a href="{{ route('admin.compras') }}" class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                        <p class="text-sm text-slate-600">Acompanhar compras</p>
                        <p class="mt-2 text-lg font-bold text-slate-900">Compras</p>
                    </a>
                    <a href="{{ route('admin.mensagens') }}" class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-left transition hover:border-orange-300 hover:bg-orange-50">
                        <p class="text-sm text-slate-600">Responder clientes</p>
                        <p class="mt-2 text-lg font-bold text-slate-900">Mensagens</p>
                    </a>
                </div>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-xl font-bold text-slate-900">Resumo rápido</h2>
                <ul class="space-y-4 text-sm text-slate-600">
                    <li class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Total de pedidos</span>
                        <strong class="text-slate-900">{{ $total_pedidos }}</strong>
                    </li>
                    <li class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Total de compras</span>
                        <strong class="text-slate-900">{{ $total_compras }}</strong>
                    </li>
                    <li class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Receita</span>
                        <strong class="text-orange-600">€ {{ number_format($total_vendido, 2, ',', '.') }}</strong>
                    </li>
                    <li class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 px-4 py-3">
                        <span>Mensagens não lidas</span>
                        <strong class="text-slate-900">{{ $mensagens_nao_lidas }}</strong>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</div>
@endsection