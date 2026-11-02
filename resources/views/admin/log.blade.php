@extends('layouts.app')

@section('title', 'Log de Atividades')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Segurança</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Log de Atividades</h1>
                <p class="mt-2 text-sm text-slate-600">Acompanhe as ações relevantes do painel administrativo.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
                <span class="text-sm text-slate-500">Registos hoje</span>
                <p class="mt-1 text-3xl font-extrabold text-orange-600">{{ $atividades->count() }}</p>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($atividades as $atividade)
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-orange-300 hover:shadow-md">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M12 3v10m0 0 4-4m-4 4-4-4M5 18h14" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-base font-bold text-slate-900">{{ $atividade['titulo'] }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $atividade['descricao'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3 md:justify-end">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-600">
                                {{ $atividade['tipo'] }}
                            </span>
                            <span class="text-sm text-slate-500">{{ \Carbon\Carbon::parse($atividade['data'])->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500">
                    Sem atividades registadas.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection