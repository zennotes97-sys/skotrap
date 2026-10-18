@extends('layouts.app')

@section('title', 'Promoções')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen max-w-6xl">
    <div class="flex items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Promoções</h1>
            <p class="text-sm text-zinc-500 mt-2">Crie ofertas por percentual ou valor fixo e destaque as estampas em destaque.</p>
        </div>
        <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-orange-600">
            {{ $promocoes->count() }} ativos
        </span>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-[420px_minmax(0,1fr)]">
        <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-zinc-900 mb-5">Nova promoção</h2>

            <form action="{{ route('admin.promocoes.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="mb-2 block text-sm font-medium text-zinc-700">Estampa</label>
                    <select name="estampa_id" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" required>
                        <option value="">Selecione a estampa</option>
                        @foreach($estampas as $estampa)
                            <option value="{{ $estampa->id }}">{{ $estampa->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-zinc-700">Tipo</label>
                        <select name="tipo" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" required>
                            <option value="percent">Porcentagem</option>
                            <option value="fixed">Valor fixo</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-zinc-700">Valor</label>
                        <input type="number" step="0.01" min="0" name="valor" value="10" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-zinc-700">Início</label>
                        <input type="datetime-local" name="inicio" value="{{ now()->format('Y-m-d\TH:i') }}" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-zinc-700">Fim</label>
                        <input type="datetime-local" name="fim" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                </div>

                <label class="flex items-center gap-3 rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-700">
                    <input type="checkbox" name="ativo" value="1" checked class="h-4 w-4 rounded border-zinc-300 text-orange-600 focus:ring-orange-500">
                    Promoção ativa
                </label>

                <button type="submit" class="w-full rounded-2xl bg-orange-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                    Salvar promoção
                </button>
            </form>
        </section>

        <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-semibold text-zinc-900">Promoções ativas</h2>
                <span class="text-sm text-zinc-500">{{ $promocoes->count() }} registros</span>
            </div>

            <div class="space-y-4">
                @forelse($promocoes as $promocao)
                    @php
                        $estampa = $promocao->estampa;
                        $imagem = $estampa && $estampa->imagem ? asset('storage/' . $estampa->imagem) : asset('imagens/Animes.png');
                    @endphp

                    <div class="flex gap-4 rounded-2xl border border-zinc-200 bg-zinc-50 p-3">
                        <img src="{{ $imagem }}" alt="{{ $estampa->nome ?? 'Estampa' }}" class="h-20 w-20 rounded-xl object-cover border border-zinc-200">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-zinc-900">{{ $estampa->nome ?? 'Estampa removida' }}</h3>
                                    <p class="text-sm text-zinc-500">
                                        {{ $promocao->tipo === 'percent' ? $promocao->valor . '% de desconto' : 'Desconto de MZN ' . number_format($promocao->valor, 2, ',', '.') }}
                                    </p>
                                </div>
                                <span class="rounded-full {{ $promocao->ativo ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-200 text-zinc-600' }} px-2 py-1 text-[10px] font-semibold uppercase tracking-wider">
                                    {{ $promocao->ativo ? 'Ativa' : 'Inativa' }}
                                </span>
                            </div>

                            <div class="mt-3 flex items-center justify-between gap-3 text-xs text-zinc-500">
                                <span>Inicio: {{ $promocao->inicio ? \Carbon\Carbon::parse($promocao->inicio)->format('d/m/Y H:i') : 'Agora' }}</span>
                                <span>Fim: {{ $promocao->fim ? \Carbon\Carbon::parse($promocao->fim)->format('d/m/Y H:i') : 'Sem limite' }}</span>
                            </div>

                            <form action="{{ route('admin.promocoes.destroy', $promocao->id) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                    Remover
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-zinc-300 bg-zinc-50 p-8 text-center text-sm text-zinc-500">
                        Ainda não há promoções cadastradas.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection

