@extends('layouts.app')

@section('title', 'Configurações')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Loja</p>
            <h1 class="text-3xl font-black tracking-tight text-slate-900">Configurações</h1>
            <p class="mt-2 text-sm text-slate-600">Gerencie as configurações gerais da sua loja.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-xl font-bold text-slate-900">Configurações Gerais</h2>
            <p class="mb-6 text-sm text-slate-500">
                Esta área ainda está em desenvolvimento. Aqui você poderá configurar informações importantes da sua loja, como:
            </p>

            <div class="space-y-4">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="font-semibold text-slate-800">Informações da Loja</h3>
                    <p class="mt-1 text-xs text-slate-500">Nome da loja, e-mail de contato, endereço, etc.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="font-semibold text-slate-800">Integrações de Pagamento</h3>
                    <p class="mt-1 text-xs text-slate-500">Configurar chaves de API para gateways como Stripe ou PayPal.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="font-semibold text-slate-800">Opções de Envio</h3>
                    <p class="mt-1 text-xs text-slate-500">Definir custos de frete, zonas de entrega e integrações com transportadoras.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection