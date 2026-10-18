@extends('layouts.app')

@section('title', 'Configurações')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Configurações</h1>
            <p class="text-sm text-zinc-500 mt-2">Gerencie as configurações gerais da sua loja.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-zinc-800 mb-4">Configurações Gerais</h2>
        <p class="text-sm text-zinc-500 mb-6">
            Esta área ainda está em desenvolvimento. Aqui você poderá configurar informações importantes da sua loja, como:
        </p>

        <div class="space-y-4">
            <div class="p-4 border rounded-lg bg-zinc-50">
                <h3 class="font-semibold text-zinc-700">Informações da Loja</h3>
                <p class="text-xs text-zinc-500">Nome da loja, e-mail de contato, endereço, etc.</p>
            </div>
            <div class="p-4 border rounded-lg bg-zinc-50">
                <h3 class="font-semibold text-zinc-700">Integrações de Pagamento</h3>
                <p class="text-xs text-zinc-500">Configurar chaves de API para gateways como Stripe ou PayPal.</p>
            </div>
            <div class="p-4 border rounded-lg bg-zinc-50">
                <h3 class="font-semibold text-zinc-700">Opções de Envio</h3>
                <p class="text-xs text-zinc-500">Definir custos de frete, zonas de entrega e integrações com transportadoras.</p>
            </div>
        </div>

    </div>
</div>
@endsection