@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Analytics</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Relatórios</h1>
                <p class="mt-2 text-sm text-slate-600">Analise o desempenho da sua loja e gere ficheiros estruturados.</p>
            </div>
        </div>

        <div class="mb-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M4 19h16M7 15V8m5 7V5m5 10v-4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="text-sm text-slate-500">Total de vendas</p>
                <p class="mt-1 text-3xl font-extrabold text-slate-900">{{ $total_vendas ?? 0 }}</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 1v20M17 5H9.5a3.5 3.5 0 0 0 0 7H14.5a3.5 3.5 0 0 1 0 7H6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="text-sm text-slate-500">Receita total</p>
                <p class="mt-1 text-3xl font-extrabold text-slate-900">€ {{ number_format($receita_total ?? 0, 2, ',', '.') }}</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M16 19a4 4 0 1 0-8 0M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="text-sm text-slate-500">Clientes ativos</p>
                <p class="mt-1 text-3xl font-extrabold text-slate-900">{{ $clientes_ativos ?? 0 }}</p>
            </div>
        </div>

        <div class="mb-8 grid gap-6 xl:grid-cols-[1.6fr_0.9fr]">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Faturamento</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900">Receita mensal</h2>
                    </div>
                    <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                        +{{ $crescimento ?? 0 }}%
                    </span>
                </div>

                <div class="flex h-52 items-end gap-3">
                    @forelse($vendasMensais ?? collect() as $mes)
                        <div class="flex flex-1 flex-col items-center gap-3">
                            <div class="flex h-40 w-full items-end justify-center">
                                <div class="w-full rounded-t-2xl bg-gradient-to-t from-orange-600 via-orange-400 to-amber-300 shadow-[0_12px_35px_rgba(249,115,22,0.25)]" style="height: {{ $mes->altura ?? 20 }}%"></div>
                            </div>
                            <span class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">{{ $mes->mes_label }}</span>
                        </div>
                    @empty
                        <div class="w-full rounded-2xl bg-slate-50 px-4 py-8 text-sm text-slate-500">Sem dados de faturamento.</div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Conversão</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900">Performance</h2>
                    </div>
                </div>

                @php
                    $conversaoPorcentagem = min(100, max(0, (int) ($taxa_conversao ?? 0)));
                @endphp

                <div class="mx-auto mt-4 flex h-40 w-40 items-center justify-center">
                    <div class="relative h-full w-full rounded-full" style="background: conic-gradient(#f97316 0 {{ $conversaoPorcentagem }}%, #fdba74 {{ $conversaoPorcentagem }}% 70%, #e2e8f0 70% 100%);">
                        <div class="absolute inset-3 rounded-full bg-white shadow-inner"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                            <span class="text-3xl font-black text-slate-900">{{ $conversaoPorcentagem }}%</span>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Conversão</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-3 py-2">
                        <span class="text-sm text-slate-600">Pedidos</span>
                        <span class="text-sm font-bold text-slate-900">{{ $pedidos_totais ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-3 py-2">
                        <span class="text-sm text-slate-600">Vendas concluídas</span>
                        <span class="text-sm font-bold text-orange-600">{{ $total_vendas ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M7 17V7m5 10V4m5 13v-7M5 19h14" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Gerar relatório</h2>
                    <p class="text-sm text-slate-500">Exporta uma CSV com dados de vendas, produtos ou clientes.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.relatorios.gerar') }}" class="grid gap-4 md:grid-cols-4">
                @csrf
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Tipo</span>
                    <select name="tipo" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 outline-none focus:border-orange-400">
                        <option value="vendas">Vendas</option>
                        <option value="produtos">Produtos</option>
                        <option value="clientes">Clientes</option>
                    </select>
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Data início</span>
                    <input type="date" name="inicio" value="{{ now()->subDays(30)->toDateString() }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 outline-none focus:border-orange-400">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Data fim</span>
                    <input type="date" name="fim" value="{{ now()->toDateString() }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 outline-none focus:border-orange-400">
                </label>

                <div class="flex items-end">
                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M12 3v12m0 0 4-4m-4 4-4-4M5 18h14" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Gerar CSV
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900">Top produtos</h3>
                <div class="mt-5 space-y-4">
                    @forelse($produtos_mais_vendidos ?? collect() as $produto)
                        @php
                            $maxUnidades = $produtos_mais_vendidos->max('quantidade_total') ?? 1;
                            $percentual = max(16, min(100, round(($produto->quantidade_total / max(1, $maxUnidades)) * 100)));
                        @endphp
                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <span class="text-sm font-medium text-slate-700">Produto #{{ $produto->estampa_id }}</span>
                                <span class="text-sm font-bold text-orange-600">{{ $produto->quantidade_total }} unidades</span>
                            </div>
                            <div class="h-2.5 w-full overflow-hidden rounded-full bg-slate-100">
                                <div class="h-full rounded-full bg-gradient-to-r from-orange-500 to-amber-300" style="width: {{ $percentual }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-500">Sem dados de produtos vendidos.</div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900">Resumo rápido</h3>
                <div class="mt-5 space-y-3">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Receita</p>
                        <p class="mt-2 text-2xl font-black text-slate-900">€ {{ number_format($receita_total ?? 0, 2, ',', '.') }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Clientes</p>
                        <p class="mt-2 text-2xl font-black text-slate-900">{{ $clientes_ativos ?? 0 }}</p>
                    </div>
                    <div class="rounded-2xl bg-orange-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange-600">Taxa de conversão</p>
                        <p class="mt-2 text-2xl font-black text-orange-600">{{ $taxa_conversao ?? 0 }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection