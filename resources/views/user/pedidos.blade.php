@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900">Carrinho</h2>
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