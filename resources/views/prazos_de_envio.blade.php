@extends('layouts.info')

@section('title', 'Prazos de Envio')
@section('eyebrow', 'Da preparação à sua porta')
@section('heading', 'Prazos de Envio')
@section('intro', 'O envio acontece depois da preparação da encomenda. O tempo de transporte depende do destino e é confirmado com cada cliente.')

@section('content')
<section class="grid gap-4 md:grid-cols-2">
    <article class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
        <span class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400"><i class="fas fa-box-open" aria-hidden="true"></i></span>
        <p class="text-xs font-bold uppercase tracking-widest text-orange-400">Etapa 01</p>
        <h2 class="mt-2 text-xl font-bold text-white">Preparação</h2>
        <p class="mt-3 leading-7 text-zinc-400">Confirmamos o artigo, as especificações e a disponibilidade. Encomendas personalizadas podem exigir tempo de produção antes de estarem prontas para envio.</p>
    </article>
    <article class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
        <span class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400"><i class="fas fa-truck" aria-hidden="true"></i></span>
        <p class="text-xs font-bold uppercase tracking-widest text-orange-400">Etapa 02</p>
        <h2 class="mt-2 text-xl font-bold text-white">Transporte</h2>
        <p class="mt-3 leading-7 text-zinc-400">Depois de preparada, a encomenda é entregue ou encaminhada conforme a opção combinada. O tempo de transporte varia consoante o endereço e o serviço disponível.</p>
    </article>
</section>

<section class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Endereço e acompanhamento</h2>
    <div class="mt-4 space-y-3 leading-7 text-zinc-400">
        <p>Verifique se o nome, telefone e endereço fornecidos estão correctos e se alguém poderá receber a encomenda. Avise-nos rapidamente caso precise de corrigir os dados, pois alterações podem não ser possíveis depois de o envio ser iniciado.</p>
        <p>Quando existir informação de acompanhamento, partilharemos os dados disponíveis. Em caso de atraso ou dificuldade na entrega, contacte-nos com a referência da encomenda para podermos ajudar.</p>
    </div>
</section>

<section class="rounded-3xl border border-orange-500/20 bg-orange-500/5 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Custos e previsão</h2>
    <p class="mt-3 leading-7 text-zinc-400">O custo do envio e a previsão de chegada são confirmados antes da conclusão da encomenda. Podem variar de acordo com o destino, o método de entrega e as características do pedido. Consulte também <a href="{{ route('support.prazos') }}" class="text-orange-400 underline underline-offset-4 hover:text-orange-300">Prazos de Entrega</a>.</p>
</section>
@endsection
