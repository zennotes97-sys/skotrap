@extends('layouts.info')

@section('title', 'Perguntas frequentes')
@section('eyebrow', 'Estamos aqui para ajudar')
@section('heading', 'Perguntas frequentes')
@section('intro', 'Encontre respostas rápidas sobre encomendas, personalização, tamanhos, pagamentos e acompanhamento. Se precisar de ajuda com um caso específico, fale connosco.')

@section('content')
<div class="space-y-3">
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            Como faço uma encomenda?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">Escolha o artigo ou estampa que pretende e contacte-nos para confirmar os detalhes da encomenda. Antes de avançar, confirmaremos consigo o produto, a personalização, o preço, a disponibilidade e as opções de entrega.</p>
    </details>
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            Posso pedir uma estampa personalizada?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">Fale connosco com a sua ideia e, se já tiver, envie a arte ou referência. A possibilidade de produção, os requisitos do ficheiro e o preço são confirmados caso a caso antes de iniciar o trabalho.</p>
    </details>
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            Quais são os meios de pagamento?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">As opções disponíveis e os dados para pagamento serão indicados pela equipa durante a confirmação da encomenda. Confirme sempre o valor e as instruções antes de efectuar qualquer pagamento.</p>
    </details>
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            Quanto tempo demora a produção e a entrega?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">O prazo depende do artigo, da personalização, da disponibilidade e do destino. A previsão aplicável à sua encomenda será confirmada antes da finalização. Consulte também <a href="{{ route('support.prazos') }}" class="text-orange-400 underline underline-offset-4 hover:text-orange-300">Prazos de Entrega</a> e <a href="{{ route('support.envio') }}" class="text-orange-400 underline underline-offset-4 hover:text-orange-300">Prazos de Envio</a>.</p>
    </details>
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            Como escolho o tamanho certo?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">As medidas podem variar consoante o modelo. Consulte as indicações apresentadas para o artigo e veja o nosso <a href="{{ route('support.tamanhos') }}" class="text-orange-400 underline underline-offset-4 hover:text-orange-300">Guia de Tamanhos</a>. Se tiver dúvidas, envie-nos as suas medidas antes de encomendar.</p>
    </details>
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            Como acompanho a minha encomenda?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">Depois do envio, contacte-nos para obter a actualização disponível e, quando aplicável, os dados de acompanhamento fornecidos pelo serviço de entrega.</p>
    </details>
    <details class="group rounded-2xl border border-white/10 bg-zinc-900/70 p-5 open:border-orange-500/40">
        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-white">
            O que faço se receber um artigo com problema?
            <i class="fas fa-plus text-sm text-orange-400 transition group-open:rotate-45" aria-hidden="true"></i>
        </summary>
        <p class="mt-4 leading-7 text-zinc-400">Entre em contacto connosco assim que possível, indicando a referência da encomenda e descrevendo o problema. Fotografias do artigo e da embalagem ajudam-nos a avaliar e a encontrar a melhor solução, sem prejuízo dos direitos previstos na legislação aplicável. Consulte a <a href="{{ route('support.trocas') }}" class="text-orange-400 underline underline-offset-4 hover:text-orange-300">Política de Trocas</a>.</p>
    </details>
</div>
@endsection
