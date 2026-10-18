@extends('layouts.info')

@section('title', 'Prazos de Entrega')
@section('eyebrow', 'Informação de encomendas')
@section('heading', 'Prazos de Entrega')
@section('intro', 'Cada encomenda é diferente. A previsão de entrega é confirmada antes da finalização para que saiba o que esperar.')

@section('content')
<section class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
    <div class="flex gap-4">
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400"><i class="fas fa-calendar-check" aria-hidden="true"></i></span>
        <div>
            <h2 class="text-xl font-bold text-white">Quando começa a contar o prazo?</h2>
            <p class="mt-3 leading-7 text-zinc-400">O prazo começa após a confirmação da encomenda e dos respectivos detalhes. Se houver personalização, a produção só avança depois de a arte, o artigo e as especificações ficarem acordados.</p>
        </div>
    </div>
</section>

<section class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
    <div class="flex gap-4">
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-500/10 text-orange-400"><i class="fas fa-stopwatch" aria-hidden="true"></i></span>
        <div>
            <h2 class="text-xl font-bold text-white">O que pode influenciar a previsão?</h2>
            <ul class="mt-4 space-y-3 text-zinc-400">
                <li class="flex gap-3"><i class="fas fa-check mt-1 text-orange-400" aria-hidden="true"></i><span>Disponibilidade do artigo e dos materiais necessários.</span></li>
                <li class="flex gap-3"><i class="fas fa-check mt-1 text-orange-400" aria-hidden="true"></i><span>Complexidade e aprovação de estampas ou personalizações.</span></li>
                <li class="flex gap-3"><i class="fas fa-check mt-1 text-orange-400" aria-hidden="true"></i><span>Local de entrega e disponibilidade do serviço de transporte.</span></li>
                <li class="flex gap-3"><i class="fas fa-check mt-1 text-orange-400" aria-hidden="true"></i><span>Feriados, períodos de maior procura e circunstâncias fora do nosso controlo.</span></li>
            </ul>
        </div>
    </div>
</section>

<section class="rounded-3xl border border-orange-500/20 bg-orange-500/5 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Confirmação da data prevista</h2>
    <p class="mt-3 leading-7 text-zinc-400">Não publicamos um prazo único que se aplique a todos os produtos e destinos. A equipa informa a previsão e eventuais custos de entrega antes de a encomenda ser finalizada. Se a previsão mudar, entraremos em contacto para combinar os próximos passos.</p>
    <a href="{{ route('support.envio') }}" class="mt-5 inline-flex items-center gap-2 font-semibold text-orange-400 hover:text-orange-300">Ver prazos de envio <i class="fas fa-arrow-right text-xs" aria-hidden="true"></i></a>
</section>
@endsection