@extends('layouts.info')

@section('title', 'Guia de Tamanhos')
@section('eyebrow', 'Encontre o seu ajuste')
@section('heading', 'Guia de Tamanhos')
@section('intro', 'Use estas orientações para comparar as medidas de uma peça que já lhe assenta bem. O corte e as dimensões podem variar entre modelos.')

@section('content')
<section class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Como tirar as medidas</h2>
    <p class="mt-3 leading-7 text-zinc-400">Coloque uma peça semelhante numa superfície plana, sem esticar o tecido. Meça com uma fita métrica e compare os resultados com a informação do artigo escolhido.</p>
    <div class="mt-6 grid gap-4 sm:grid-cols-3">
        <article class="rounded-2xl border border-white/10 bg-zinc-950/70 p-5">
            <span class="text-sm font-bold text-orange-400">01 · Peito</span>
            <p class="mt-2 text-sm leading-6 text-zinc-400">Meça de uma axila à outra, em linha recta, com a peça deitada.</p>
        </article>
        <article class="rounded-2xl border border-white/10 bg-zinc-950/70 p-5">
            <span class="text-sm font-bold text-orange-400">02 · Comprimento</span>
            <p class="mt-2 text-sm leading-6 text-zinc-400">Meça do ponto mais alto do ombro até à base da peça.</p>
        </article>
        <article class="rounded-2xl border border-white/10 bg-zinc-950/70 p-5">
            <span class="text-sm font-bold text-orange-400">03 · Manga</span>
            <p class="mt-2 text-sm leading-6 text-zinc-400">Quando aplicável, meça da costura do ombro até à extremidade da manga.</p>
        </article>
    </div>
</section>

<section class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Antes de escolher</h2>
    <ul class="mt-4 space-y-3 text-zinc-400">
        <li class="flex gap-3"><i class="fas fa-ruler mt-1 text-orange-400" aria-hidden="true"></i><span>Consulte as medidas indicadas na página do produto, quando disponíveis. Não existe uma tabela universal para todos os modelos.</span></li>
        <li class="flex gap-3"><i class="fas fa-ruler mt-1 text-orange-400" aria-hidden="true"></i><span>Se estiver entre dois tamanhos, pense no ajuste que prefere e compare com uma peça confortável que já tenha.</span></li>
        <li class="flex gap-3"><i class="fas fa-ruler mt-1 text-orange-400" aria-hidden="true"></i><span>As medições podem apresentar pequenas diferenças. O material, o corte e a forma de lavagem também podem influenciar o ajuste.</span></li>
    </ul>
</section>

<section class="rounded-3xl border border-orange-500/20 bg-orange-500/5 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Quer confirmar antes de encomendar?</h2>
    <p class="mt-3 leading-7 text-zinc-400">Envie-nos o nome do modelo e as medidas da peça que costuma usar. A equipa verificará a informação disponível para ajudar na escolha.</p>
</section>
@endsection
