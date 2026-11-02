@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 shadow-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5" aria-hidden="true">
                        <path d="M3 5h2l2.1 9.3a1 1 0 0 0 1 .8h8.9a1 1 0 0 0 1-.8L20 7H7"/>
                        <circle cx="10" cy="18.5" r="1.3"/>
                        <circle cx="17" cy="18.5" r="1.3"/>
                    </svg>
                </span>
                <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900">Carrinho</h2>
            </div>
            <p class="text-sm text-zinc-500 mt-1">Revise as estampas adicionadas antes de confirmar o pedido.</p>
        </div>
        <div class="flex gap-2">
            <button id="clearCartButton" type="button" class="rounded-full border border-zinc-300 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                Limpar carrinho
            </button>
            <button id="checkoutCartButton" type="button" class="rounded-full bg-orange-500 px-4 py-2 text-sm font-semibold text-black hover:bg-orange-400">
                Confirmar no WhatsApp
            </button>
        </div>
    </div>

    <div id="cartItemsContainer" class="mb-8">
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 text-zinc-800">
            <p class="text-sm">Carregando itens do carrinho...</p>
        </div>
    </div>
</div>

<script>
  window.addEventListener('load', function() {
    if (typeof window.renderCartInPedidos === 'function') {
      window.renderCartInPedidos();
    }
  });
</script>
@endsection