@extends('layouts.info')

@section('title', 'Política de Trocas')
@section('eyebrow', 'Compra com confiança')
@section('heading', 'Política de Trocas')
@section('intro', 'Se algo não estiver como esperado, fale connosco. Vamos analisar a situação e indicar os próximos passos de forma clara.')

@section('content')
<section class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Como solicitar ajuda</h2>
    <ol class="mt-5 space-y-4">
        <li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-500 text-sm font-black text-zinc-950">1</span><span class="pt-1 leading-6 text-zinc-400">Contacte-nos assim que possível, indicando o nome usado na encomenda e a respectiva referência, se disponível.</span></li>
        <li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-500 text-sm font-black text-zinc-950">2</span><span class="pt-1 leading-6 text-zinc-400">Explique o motivo do pedido. Se o artigo chegou danificado, com defeito ou diferente do confirmado, inclua fotografias que ajudem a perceber o problema.</span></li>
        <li class="flex gap-4"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-500 text-sm font-black text-zinc-950">3</span><span class="pt-1 leading-6 text-zinc-400">A nossa equipa avaliará o caso e confirmará consigo a solução adequada, os prazos e as instruções de devolução, quando aplicável.</span></li>
    </ol>
</section>

<section class="grid gap-4 md:grid-cols-2">
    <article class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-white">Artigo com defeito ou diferente</h2>
        <p class="mt-3 leading-7 text-zinc-400">Se receber um artigo com defeito ou que não corresponda ao que foi confirmado, informe-nos para que possamos analisar e resolver a situação. Os direitos previstos na legislação aplicável mantêm-se salvaguardados.</p>
    </article>
    <article class="rounded-3xl border border-white/10 bg-zinc-900/70 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-white">Troca por preferência ou tamanho</h2>
        <p class="mt-3 leading-7 text-zinc-400">A possibilidade de troca por preferência, cor ou tamanho depende do estado do artigo, da disponibilidade e de se tratar de uma peça personalizada. Contacte-nos antes de enviar qualquer artigo; confirmaremos as opções para o seu caso.</p>
    </article>
</section>

<section class="rounded-3xl border border-orange-500/20 bg-orange-500/5 p-6 sm:p-8">
    <h2 class="text-xl font-bold text-white">Importante</h2>
    <p class="mt-3 leading-7 text-zinc-400">Não envie artigos sem instruções prévias da equipa. Esta política não limita quaisquer direitos ou garantias que lhe sejam reconhecidos pela legislação aplicável. As condições específicas e os custos de devolução serão comunicados antes de qualquer procedimento.</p>
</section>
@endsection
