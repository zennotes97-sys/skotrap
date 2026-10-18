<!DOCTYPE html>
<html lang="pt-MZ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#09090b">
    <title>@yield('title') | SKO-TRAP</title>
    <link rel="shortcut icon" href="{{ asset('imagens/logo-SKO-TRAKP.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100 antialiased">
    <header class="border-b border-white/10 bg-zinc-950/95">
        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-5 py-5 sm:px-8 lg:flex-row lg:items-center lg:justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-xl font-black tracking-tight text-white" aria-label="SKO-TRAP — página inicial">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-zinc-950"><i class="fas fa-bolt"></i></span>
                <span>SKO<span class="text-orange-500">-</span>TRAP</span>
            </a>
            <nav aria-label="Navegação de suporte" class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-zinc-400">
                <a href="{{ route('support.faqs') }}" class="transition hover:text-orange-400">FAQs</a>
                <a href="{{ route('support.prazos') }}" class="transition hover:text-orange-400">Entrega</a>
                <a href="{{ route('support.envio') }}" class="transition hover:text-orange-400">Envio</a>
                <a href="{{ route('support.tamanhos') }}" class="transition hover:text-orange-400">Tamanhos</a>
                <a href="{{ route('support.trocas') }}" class="transition hover:text-orange-400">Trocas</a>
                <a href="{{ route('support.termos') }}" class="transition hover:text-orange-400">Termos</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-12 sm:px-8 sm:py-16">
        <div class="mb-10 border-b border-white/10 pb-9">
            <p class="mb-3 text-xs font-bold uppercase tracking-[0.22em] text-orange-400">@yield('eyebrow', 'Ajuda SKO-TRAP')</p>
            <h1 class="text-3xl font-black tracking-tight text-white sm:text-5xl">@yield('heading')</h1>
            <p class="mt-4 max-w-3xl text-base leading-7 text-zinc-400 sm:text-lg">@yield('intro')</p>
        </div>

        <div class="space-y-6">
            @yield('content')
        </div>

        <aside class="mt-12 rounded-3xl border border-orange-500/20 bg-gradient-to-br from-orange-500/10 to-zinc-900 p-6 sm:p-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-lg font-bold text-white">Precisa de ajuda com o seu pedido?</p>
                    <p class="mt-1 text-sm leading-6 text-zinc-400">A nossa equipa pode confirmar os detalhes antes de finalizar a compra.</p>
                </div>
                <a href="https://wa.me/258873182096" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 font-bold text-zinc-950 transition hover:bg-orange-400" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    Falar connosco
                </a>
            </div>
        </aside>
    </main>

    <footer class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-5 py-7 text-sm text-zinc-500 sm:px-8 md:flex-row md:items-center md:justify-between">
            <a href="{{ route('home') }}" class="font-bold text-zinc-300 transition hover:text-orange-400">SKO-TRAP</a>
            <p>&copy; {{ date('Y') }} SKO-TRAP. Todos os direitos reservados.</p>
            <a href="{{ route('home') }}" class="transition hover:text-orange-400">Voltar à loja</a>
        </div>
    </footer>
</body>
</html>
