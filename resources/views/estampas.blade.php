<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKO-TRAP | Estampagem Premium</title>
   <link rel="shortcut icon" href="{{ asset('imagens/logo-SKO-TRAKP.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    .progress-bar { position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg,#ff8c00,#ff6b35); width:0; z-index:99999; box-shadow:0 0 10px rgba(255,140,0,0.8); transition: width .3s ease, opacity .3s ease; display:none; opacity:0 }
    .progress-bar.active{ display:block; opacity:1 }
    body.searching header,
    body.searching footer,
    body.searching #estampaModal,
    body.searching #promocoes {
      display: none !important;
    }
    body.searching main#estampas {
      display: block !important;
      opacity: 1 !important;
    }
    body.searching {
      overflow: auto;
    }
    .promo-carousel-shell { position: relative; }
    .promo-carousel { overflow: hidden; }
    .promo-track { display: flex; gap: 1.25rem; transition: transform 0.45s ease; }
    .promo-slide { flex: 0 0 calc(100% - 0.25rem); }
    @media (min-width: 768px) {
      .promo-slide { flex-basis: calc(50% - 0.625rem); }
    }
    .promo-arrow { backdrop-filter: blur(10px); }
    .promo-arrow:disabled { opacity: 0.4; cursor: not-allowed; }
  </style>
</head>
<body class="bg-neutral-900 text-white overflow-x-hidden pt-20">

  {{-- 1. NAVBAR (A sua estrutura original com pequenas correções de espaçamento) --}}

  <div class="progress-bar" id="progressBar"></div>
  <nav id="navbar" class="bg-neutral-950 fixed top-0 w-full z-50 transition-all duration-300 border-b border-zinc-800/50">
    <div id="navbar-container" class="max-w-7xl mx-auto px-4 sm:px-6 py-5 flex items-center justify-between transition-all duration-300">
      <div id="mobile-navbar-main" class="flex items-center gap-5">
        <h1 class="text-2xl sm:text-4xl font-bold tracking-tighter logo-glow flex items-center gap-3">
          <div class="music-equalizer flex items-end gap-[3px] h-6 text-orange-400">
            <div class="w-1 bg-orange-400 rounded-full animate-music-bar1"></div>
            <div class="w-1 bg-orange-400 rounded-full animate-music-bar2"></div>
            <div class="w-1 bg-orange-400 rounded-full animate-music-bar3"></div>
            <div class="w-1 bg-orange-400 rounded-full animate-music-bar4"></div>
          </div>
          <span>SKO-TRAP</span>
        </h1>
      </div>
      
      <div class="hidden md:flex items-center gap-6 lg:gap-8 text-base font-medium">
        <a href="/" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-home"></i> Início</a>
        <a href="#estampas" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-tshirt"></i> Estampas</a>
        <a href="#promocoes" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-tags"></i> Promoções</a>
        <a href="#contato" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-envelope"></i> Contato</a>
      </div>

      <div class="search-container relative hidden md:block">
        <input type="text" id="searchInput" placeholder="Pesquisar estampa..." class="bg-neutral-900 border border-zinc-800 text-white rounded-full py-2 px-4 pr-10 text-sm focus:outline-none focus:border-orange-500 transition-all">
        <button id="searchButton" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-orange-400 hover:text-orange-500"><i class="fas fa-search"></i></button>
      </div>

      <div class="hidden md:flex items-center gap-4">
        @auth
        <div class="relative group z-[9999]">
          <button class="px-5 py-2.5 bg-orange-500 text-black rounded-full font-semibold transition-all flex items-center gap-3 hover:bg-orange-600">
            <i class="fas fa-user"></i> {{ auth()->user()->nome }}
            <span id="cartCountBadgeNav" class="hidden min-w-5 h-5 rounded-full bg-black text-[10px] font-bold text-orange-400 flex items-center justify-center px-1">0</span>
            <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
          </button>
          <div class="absolute right-0 top-full mt-2 w-48 bg-zinc-950 border border-zinc-800 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-[9999]">
            <a href="{{ route('user.dashboard') }}" class="block px-6 py-3 hover:bg-zinc-900 rounded-t-2xl flex items-center gap-2"><i class="fas fa-chart-line text-orange-500"></i> Painel</a>
             <a href="{{ route('user.pedidos') }}" class="block px-6 py-3 hover:bg-zinc-900 flex items-center gap-2 border-t border-zinc-900">
               <i class="fas fa-shopping-cart text-orange-500"></i> Pedidos
               <span id="cartCountBadgeMenu" class="ml-auto hidden rounded-full bg-orange-500 px-2 py-0.5 text-[10px] font-bold text-black">0</span>
             </a>
               <a href="{{ route('user.compras') }}" class="block px-6 py-3 hover:bg-zinc-900 flex items-center gap-2 border-t border-zinc-900"><i class="fas fa-box text-orange-500"></i> Compras</a>
            <a href="{{ route('user.perfil') }}" class="block px-6 py-3 hover:bg-zinc-900 flex items-center gap-2 border-t border-zinc-900"><i class="fas fa-user-edit text-orange-500"></i> Perfil</a>
              @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-white hover:bg-zinc-800 transition-colors flex items-center gap-2 border-t border-zinc-800">
              <i class="fas fa-crown text-orange-500"></i> Admin
            </a>
            @endif
            <form action="{{ route('logout') }}" method="POST" class="block border-t border-zinc-900">
              @csrf
              <button type="submit" class="w-full text-left px-6 py-3 text-red-400 hover:bg-zinc-900 rounded-b-2xl flex items-center gap-2"><i class="fas fa-sign-out-alt"></i> Sair</button>
            </form>
          </div>
        </div>
        @endauth

        @guest
        <a href="{{ route('login') }}" class="px-5 py-2.5 border border-orange-500 text-orange-400 hover:bg-orange-500/10 rounded-full font-semibold transition-all">Login</a>
        <a href="{{ route('registro') }}" class="px-5 py-2.5 bg-orange-500 text-black hover:bg-orange-600 rounded-full font-semibold transition-all">Registro</a>
        @endguest
      </div>

      <button id="mobile-search-btn" type="button" class="md:hidden text-white text-xl p-2 hover:text-orange-400 transition-colors" aria-label="Pesquisar estampas" title="Pesquisar estampas">
        <i class="fas fa-search"></i>
      </button>

      <button id="mobile-menu-btn" type="button" class="md:hidden text-white text-2xl p-2" aria-label="Abrir menu" title="Abrir menu">
        <i class="fas fa-bars"></i>
      </button>

      <div id="mobile-search-bar" class="hidden md:hidden flex-1 items-center gap-2">
        <button id="mobile-search-back" type="button" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-white hover:bg-zinc-800 hover:text-orange-400 transition-colors" aria-label="Voltar" title="Voltar">
          <i class="fas fa-arrow-left"></i>
        </button>
        <div class="search-container relative flex-1">
          <input type="text" id="mobileSearchInput" placeholder="Pesquisar estampa..." class="w-full bg-neutral-900 border border-zinc-800 text-white rounded-full py-2 px-4 pr-10 text-sm focus:outline-none focus:border-orange-500 transition-all">
          <button id="mobileSearchButton" type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-orange-400 hover:text-orange-500" aria-label="Pesquisar">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-neutral-950 border-b border-zinc-800 px-6 py-4 space-y-4">
      <a href="/" class="block py-2 text-base hover:text-orange-400"><i class="fas fa-home mr-2"></i> Início</a>
      <a href="#estampas" class="block py-2 text-base hover:text-orange-400"><i class="fas fa-tshirt mr-2"></i> Estampas</a>
      <a href="#promocoes" class="block py-2 text-base hover:text-orange-400"><i class="fas fa-tags mr-2"></i> Promoções</a>
      <a href="#contato" class="block py-2 text-base hover:text-orange-400"><i class="fas fa-envelope mr-2"></i> Contato</a>

      <div class="mt-3 border-t border-zinc-800 pt-4">
        <a href="#estampas" class="flex items-center gap-3 rounded-xl bg-orange-500/10 px-4 py-3 transition hover:bg-orange-500/20">
          <span class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-500 text-black">
            <i class="fas fa-bolt"></i>
          </span>
          <span>
            <span class="block text-xs font-bold uppercase tracking-wider text-orange-400">Novo Drop Disponível</span>
            <span class="block text-sm text-zinc-300">DROP EXCLUSIVO</span>
          </span>
          <i class="fas fa-arrow-right ml-auto text-orange-400"></i>
        </a>

        @if(isset($promocoesAtivas) && $promocoesAtivas->isNotEmpty())
          <a href="#promocoes" class="mt-3 flex items-center gap-2 text-sm text-zinc-400 hover:text-orange-400">
            <i class="fas fa-tags text-orange-500"></i>
            {{ $promocoesAtivas->count() }} {{ $promocoesAtivas->count() === 1 ? 'oferta em destaque' : 'ofertas em destaque' }}
          </a>
        @endif

        <div class="mt-4 flex items-center justify-between border-t border-zinc-800 pt-4">
          @auth
            <a href="{{ route('user.perfil') }}" class="flex min-w-0 items-center gap-2 text-sm text-zinc-300 hover:text-orange-400">
              <i class="fas fa-user-circle text-orange-500"></i>
              <span class="truncate">{{ auth()->user()->nome }}</span>
            </a>
            <a href="{{ route('user.dashboard') }}" class="text-xs text-orange-400 hover:text-orange-300">Meu painel</a>
          @else
            <span class="text-sm text-zinc-500">Entre na sua conta</span>
            <a href="{{ route('login') }}" class="text-sm font-semibold text-orange-400 hover:text-orange-300">Entrar</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>


  {{-- 2. HERO SECTION (Impacto Streetwear / Underground) --}}
  <header class="relative min-h-[85vh] flex items-center justify-center bg-zinc-950 overflow-hidden">
    {{-- Efeito de Background Gradiente Desfocado --}}
    <div class="absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-orange-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-orange-600/5 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
      <div class="space-y-6 text-center lg:text-left">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900 border border-zinc-800 text-xs uppercase tracking-widest text-orange-400 font-semibold">
          <span class="flex h-2 w-2 rounded-full bg-orange-500 animate-ping"></span> Novo Drop Disponível
        </span>
        <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-none text-white">
          CULTURA TRAP <br>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-500">ESTAMPAGEM PREMIUM</span>
        </h1>
        <p class="text-zinc-400 max-w-lg mx-auto lg:mx-0 text-base sm:text-lg leading-relaxed">
          Leve o lifestyle underground para as ruas. Estampas exclusivas de alta definição em algodão pesado de gramatura premium. Garanta o seu kit.
        </p>
        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4">
          <a href="#estampas" class="px-8 py-4 bg-orange-500 text-black font-bold rounded-full transition-all hover:bg-orange-600 shadow-lg shadow-orange-500/20 active:scale-95">
            Explorar Catálogo <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <a href="#sobre" class="px-8 py-4 border border-zinc-800 text-zinc-300 font-semibold rounded-full transition-all hover:bg-zinc-900 hover:text-white">
            Conhecer a SKO
          </a>
        </div>
      </div>
      
      {{-- Banner/Imagem Destaque (Estilo Mockup ou Modelo) --}}
      <div class="relative flex items-center justify-center">
        <div class="w-72 h-72 sm:w-96 sm:h-96 rounded-full bg-orange-500/5 absolute border border-orange-500/10 animate-spin [animation-duration:20s] pointer-events-none"></div>
        <div class="relative bg-zinc-900 border border-zinc-800 p-4 rounded-3xl rotate-3 hover:rotate-0 transition-transform duration-500 shadow-2xl max-w-sm w-full">
          <div class="aspect-[4/5] overflow-hidden rounded-2xl bg-black">
            {{-- Substitua a URL fictícia abaixo pelo seu asset real de mockup/modelo --}}
            <img src="https://images.unsplash.com/photo-1554568218-0f1715e72254?auto=format&fit=crop&q=80&w=600" alt="Destaque Streetwear" class="w-full h-full object-cover">
          </div>
          <div class="pt-4 flex justify-between items-center">
            <div>
              <p class="text-sm font-bold">Oversized "Cyber Trap"</p>
              <p class="text-xs text-zinc-500">Edição Limitada</p>
            </div>
            <span class="text-orange-400 font-mono font-bold">MZN 449,90</span>
          </div>
        </div>
      </div>
    </div>
  </header>


  {{-- 3. GRID DE ESTAMPAS (Galeria Dinâmica) --}}
  <main id="estampas" class="max-w-7xl mx-auto px-4 sm:px-6 py-24">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
      <div>
        <p class="text-xs uppercase tracking-widest text-orange-400 font-bold mb-2">// O CATÁLOGO</p>
        <h2 class="text-3xl sm:text-4xl font-black tracking-tight">DROP EXCLUSIVO</h2>
      </div>
      {{-- Filtros Rápidos (Opcional) --}}
      <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 bg-orange-500 text-black text-xs font-bold rounded-full">Todas</button>
        <button class="px-4 py-2 bg-zinc-900 border border-zinc-800 text-zinc-400 text-xs font-semibold rounded-full hover:border-zinc-700 hover:text-white transition-all">Cyberpunk</button>
        <button class="px-4 py-2 bg-zinc-900 border border-zinc-800 text-zinc-400 text-xs font-semibold rounded-full hover:border-zinc-700 hover:text-white transition-all">Minimalista</button>
        <button class="px-4 py-2 bg-zinc-900 border border-zinc-800 text-zinc-400 text-xs font-semibold rounded-full hover:border-zinc-700 hover:text-white transition-all">Gothic Trap</button>
      </div>
    </div>

    {{-- Grid de Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($estampas as $estampa)
        <div class="group bg-zinc-950 border border-zinc-900 rounded-3xl p-4 transition-all hover:border-zinc-800 hover:-translate-y-1 duration-300"
             data-estampa-card
             data-search="{{ strtolower(($estampa->nome ?? '') . ' ' . ($estampa->produto ?? '') . ' ' . ($estampa->tecnica ?? '')) }}">
          <div class="relative aspect-square rounded-2xl overflow-hidden bg-zinc-900 mb-4">
            <img src="{{ $estampa->imagem ? asset('storage/' . $estampa->imagem) : asset('imagens/Animes.png') }}" alt="{{ $estampa->nome }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute top-3 left-3 bg-zinc-950/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider text-orange-400 border border-zinc-800">
              {{ $estampa->tecnica ?: 'Estampa' }}
            </div>
          </div>
          <div class="space-y-3">
            <div class="flex items-start justify-between gap-2">
              <div>
                <h3 class="font-bold text-lg text-zinc-100 group-hover:text-orange-400 transition-colors">{{ $estampa->nome }}</h3>
                <p class="text-xs text-zinc-500">{{ $estampa->produto ?: 'Camiseta / Moletom' }}</p>
              </div>
              <div class="text-right">
                <p class="font-mono font-bold text-orange-400 text-base">MZN {{ number_format($estampa->preco, 2, ',', '.') }}</p>
              </div>
            </div>
            <button type="button" onclick="openEstampaModal(this)" data-id="{{ $estampa->id }}" data-title="{{ e($estampa->nome) }}" data-description="{{ e($estampa->descricao ?: 'Estampa exclusiva da coleção SKO-TRAP.') }}" data-technique="{{ e($estampa->tecnica ?: 'Estampa Premium') }}" data-product="{{ e($estampa->produto ?: 'Camiseta / Moletom') }}" data-price="R$ {{ number_format($estampa->preco, 2, ',', '.') }}" data-image="{{ $estampa->imagem ? asset('storage/' . $estampa->imagem) : asset('imagens/Animes.png') }}" data-badge="{{ e($estampa->tecnica ?: 'Estampa Premium') }}" class="w-full py-3 bg-zinc-900 hover:bg-orange-500 text-zinc-300 hover:text-black font-semibold text-sm rounded-2xl transition-all flex items-center justify-center gap-2">
              <i class="fas fa-eye"></i> Ver detalhes
            </button>
          </div>
        </div>
      @empty
        <div class="col-span-full rounded-2xl border border-dashed border-zinc-800 bg-zinc-950/60 p-8 text-center text-zinc-400">
          Nenhuma estampa cadastrada ainda.
        </div>
      @endforelse
    </div>

    <div id="emptySearchState" class="hidden col-span-full rounded-2xl border border-dashed border-zinc-800 bg-zinc-950/60 p-8 text-center text-zinc-400">
      Nenhuma estampa encontrada com esse termo.
    </div>

     @php
      $promocoesAtivas = $promocoesAtivas ?? collect();
    @endphp

    @if($promocoesAtivas->isNotEmpty())
      <section id="promocoes" class="mt-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
          <div>
            <p class="text-xs uppercase tracking-[0.3em] text-orange-400 font-bold mb-2">PROMOÇÕES</p>
            <h2 class="text-3xl sm:text-4xl font-black tracking-tight">Ofertas em destaque</h2>
          </div>

          <div class="flex items-center gap-3">
            <span class="text-sm text-zinc-400">{{ $promocoesAtivas->count() }} em destaque</span>
            <div class="flex gap-2">
              <button type="button" id="promoPrev" class="promo-arrow inline-flex h-11 w-11 items-center justify-center rounded-full border border-zinc-700 bg-zinc-950 text-zinc-200 transition hover:border-orange-500 hover:text-orange-400">
                <i class="fas fa-arrow-left"></i>
              </button>
              <button type="button" id="promoNext" class="promo-arrow inline-flex h-11 w-11 items-center justify-center rounded-full border border-zinc-700 bg-zinc-950 text-zinc-200 transition hover:border-orange-500 hover:text-orange-400">
                <i class="fas fa-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="promo-carousel-shell">
          <div class="promo-carousel">
            <div id="promoTrack" class="promo-track">
              @foreach($promocoesAtivas as $promocao)
                @php
                  $estampaPromocao = $promocao->estampa;
                  if (!$estampaPromocao) continue;

                  $precoOriginal = (float) ($estampaPromocao->preco ?? 0);
                  $precoFinal = $promocao->tipo === 'percent'
                      ? $precoOriginal * (1 - ($promocao->valor / 100))
                      : max($precoOriginal - (float) $promocao->valor, 0);
                  $imagemPromocao = $estampaPromocao->imagem ? asset('storage/' . $estampaPromocao->imagem) : asset('imagens/Animes.png');
                @endphp

                <article class="promo-slide group overflow-hidden rounded-[28px] border border-zinc-800 bg-gradient-to-b from-zinc-950 via-zinc-950 to-zinc-900 shadow-[0_30px_80px_rgba(0,0,0,0.45)] transition duration-300 hover:-translate-y-1 hover:border-orange-500/60">
                  <div class="relative">
                    <img src="{{ $imagemPromocao }}" alt="{{ $estampaPromocao->nome }}" class="h-72 w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                    <span class="absolute left-4 top-4 rounded-full bg-orange-500 px-3 py-1 text-xs font-bold uppercase tracking-wider text-black shadow-lg shadow-orange-500/30">
                      {{ $promocao->tipo === 'percent' ? '-' . (int) $promocao->valor . '%' : 'Oferta' }}
                    </span>
                  </div>

                  <div class="space-y-4 p-5">
                    <div>
                      <h3 class="text-xl font-bold text-white">{{ $estampaPromocao->nome }}</h3>
                      <p class="mt-1 text-sm text-zinc-400">{{ $estampaPromocao->produto ?: 'Camiseta / Moletom' }}</p>
                    </div>

                    <div class="flex items-center gap-2 flex-wrap">
                      <span class="text-2xl font-bold text-orange-400">MZN {{ number_format($precoFinal, 2, ',', '.') }}</span>
                      <span class="text-base text-zinc-500 line-through">MZN {{ number_format($precoOriginal, 2, ',', '.') }}</span>
                    </div>

                    <button type="button" onclick="openEstampaModal(this)"
                      data-id="{{ $estampaPromocao->id }}"
                      data-title="{{ e($estampaPromocao->nome) }}"
                      data-description="{{ e($estampaPromocao->descricao ?: 'Estampa exclusiva em promoção.') }}"
                      data-technique="{{ e($estampaPromocao->tecnica ?: 'Estampa Premium') }}"
                      data-product="{{ e($estampaPromocao->produto ?: 'Camiseta / Moletom') }}"
                      data-price="MZN {{ number_format($precoFinal, 2, ',', '.') }}"
                      data-image="{{ $imagemPromocao }}"
                      data-badge="{{ e($promocao->tipo === 'percent' ? 'Promoção' : 'Oferta') }}"
                      class="w-full rounded-2xl bg-orange-500 px-4 py-3 text-sm font-bold text-black transition hover:bg-orange-400">
                      Ver oferta
                    </button>
                  </div>
                </article>
              @endforeach
            </div>
          </div>
        </div>
      </section>
    @endif
  </main>

  <div id="estampaModal" class="fixed inset-0 z-[9999] hidden items-start sm:items-center justify-center bg-black/85 backdrop-blur-sm p-2 sm:p-4 overflow-y-auto" onclick="closeEstampaModal(event)">
    <div class="modal-content relative w-full max-w-6xl max-h-[calc(100dvh-1rem)] sm:max-h-[calc(100vh-4rem)] my-0.5 sm:my-8 overflow-y-auto overflow-x-hidden rounded-3xl bg-zinc-950 shadow-2xl text-white transition-all duration-300" onclick="event.stopPropagation()">
      <button type="button" onclick="closeEstampaModal()" class="absolute right-4 top-4 z-20 inline-flex h-11 w-11 items-center justify-center rounded-full border border-zinc-800 bg-zinc-900/80 backdrop-blur-sm text-zinc-300 transition hover:border-orange-500 hover:text-white">
        <i class="fas fa-times"></i>
      </button>

      <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr]">
        <div class="p-4 sm:p-6 md:p-8 flex flex-col justify-between">
          <div class="grid gap-6 md:grid-cols-2">
            <div class="relative mx-auto flex h-[32vh] min-h-[190px] w-full max-w-md items-center justify-center overflow-hidden rounded-2xl bg-zinc-900 sm:min-h-[300px] sm:max-h-[500px]">
              <img id="modalImage" src="" alt="Estampa" class="h-full w-full cursor-zoom-in object-contain" onclick="openExpandedImage()" tabindex="0" role="button" />
            </div>

            <div class="flex flex-col justify-between space-y-6">
              {{-- Container para os detalhes da estampa --}}
              <div id="productDetailsPanel" class="flex flex-col justify-between space-y-6 h-full">
                <div class="space-y-3">
                  <span id="modalTechniqueBadge" class="inline-flex rounded-full bg-orange-500/10 px-3 py-1 text-xs uppercase tracking-widest text-orange-300 font-medium"></span>
                  <h2 id="modalTitle" class="text-2xl md:text-3xl font-bold tracking-tight text-white leading-tight"></h2>
                  <div class="max-h-[180px] overflow-y-auto pr-2 text-sm leading-relaxed text-zinc-400 scrollbar-thin scrollbar-thumb-zinc-800">
                    <p id="modalDescription"></p>
                  </div>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                  <div class="rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4">
                    <p class="text-xs uppercase tracking-wider text-zinc-500">Técnica</p>
                    <p id="modalTechnique" class="mt-1 text-sm font-semibold text-zinc-200"></p>
                  </div>
                  <div class="rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4">
                    <p class="text-xs uppercase tracking-wider text-zinc-500">Produto</p>
                    <p id="modalProduct" class="mt-1 text-sm font-semibold text-zinc-200"></p>
                  </div>
                  <div class="sm:col-span-2 rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4">
                    <p class="text-xs uppercase tracking-wider text-zinc-500">Preço</p>
                    <p id="modalPrice" class="mt-1 text-lg font-semibold text-orange-400"></p>
                  </div>
                </div>
                <div class="flex flex-wrap items-center gap-2.5 pt-4 border-t border-zinc-900">
                  <button id="likeButton" type="button" onclick="likeProduct()" class="flex-1 min-w-[120px] inline-flex items-center justify-center gap-2 rounded-full border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm font-semibold text-zinc-300 transition hover:border-orange-500 hover:text-orange-400">
                    <i class="fas fa-heart"></i>
                    <span id="likeText">Curtir</span>
                    <span id="likeCount" class="text-xs text-zinc-500">(0)</span>
                  </button>
                  <button id="toggleCommentButton" type="button" onclick="toggleCommentPanel()" class="flex-1 min-w-[120px] inline-flex items-center justify-center gap-2 rounded-full border border-zinc-800 bg-zinc-900 px-4 py-3 text-sm font-semibold text-zinc-300 transition hover:border-orange-500 hover:text-orange-400">
                    <i class="fas fa-comment-alt"></i>
                    Comentar
                  </button>
                  <button type="button" onclick="shareProduct()" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-zinc-800 text-zinc-300 transition hover:bg-zinc-700" title="Compartilhar">
                    <i class="fas fa-share-alt"></i>
                  </button>
                  <button id="addToCartButton" type="button" onclick="addToCart()" class="w-full sm:w-auto sm:flex-1 inline-flex items-center justify-center gap-2 rounded-full border border-zinc-800 bg-zinc-900 text-zinc-300 hover:bg-orange-500 hover:text-black px-6 py-3 text-sm font-semibold transition shadow-lg shadow-orange-500/10 active:scale-95">
                    <i class="fas fa-cart-plus"></i>
                    Adicionar ao carrinho
                  </button>
                  <button type="button" onclick="makeOrder()" class="w-full sm:w-auto sm:flex-1 inline-flex items-center justify-center gap-2 rounded-full bg-orange-500 px-6 py-3 text-sm font-semibold text-black transition hover:bg-orange-600 shadow-lg shadow-orange-500/10 active:scale-95">
                    <i class="fas fa-shopping-cart"></i>
                    Pedir agora
                  </button>
                </div>
                <div id="cartMessage" class="mt-3 text-sm font-medium text-emerald-300 hidden"></div>
              </div>

              {{-- Painel de Comentários (movido para cá) --}}
              <aside id="commentPanel" class="hidden w-full h-full flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between gap-3 pb-4 border-b border-zinc-800">
                    <div>
                      <p class="text-xs uppercase tracking-widest text-zinc-500">Comentários</p>
                      <h3 class="text-lg font-semibold text-white">Painel de Comentários</h3>
                    </div>
                    <button type="button" onclick="toggleCommentPanel()" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-zinc-800 text-zinc-400 transition hover:bg-orange-500 hover:text-black">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <div class="mt-4 max-h-[350px] lg:max-h-[450px] overflow-y-auto pr-2 text-sm text-zinc-300 scrollbar-thin scrollbar-thumb-zinc-800">
                    <div id="commentsList" class="space-y-3"></div>
                  </div>
                </div>
                <div class="mt-5 border-t border-zinc-800 pt-4">
                  <input id="commentInput" type="text" placeholder="Escreva seu comentário..." class="w-full rounded-full border border-zinc-800 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition focus:border-orange-500" />
                  <button type="button" onclick="addComment()" class="mt-3 w-full rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-black transition hover:bg-orange-600 active:scale-95">
                    Enviar comentário
                  </button>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="expandedImageModal" class="fixed inset-0 z-[10000] hidden items-center justify-center bg-black/95 p-4" onclick="closeExpandedImage(event)">
      <button type="button" onclick="closeExpandedImage()" class="absolute left-4 top-4 inline-flex h-11 w-11 items-center justify-center rounded-full border border-zinc-700 bg-zinc-900/80 text-xl text-white transition hover:border-orange-500 hover:text-orange-400" aria-label="Voltar" title="Voltar">
        <i class="fas fa-arrow-left"></i>
      </button>
      <img id="expandedModalImage" src="" alt="Estampa ampliada" class="max-h-full max-w-full object-contain" onclick="event.stopPropagation()" />
    </div>
  </div>
  {{-- 4. FOOTER (Rodapé Trap/Minimalista) --}}
  <footer id="contato" class="bg-zinc-950 border-t border-zinc-900 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
      <div class="space-y-4">
        <h3 class="text-xl font-black tracking-tighter text-white">SKO-TRAP</h3>
        <p class="text-sm text-zinc-500 leading-relaxed">
          O drop que veste a sua autenticidade. Estampagem de alto padrão técnico e curadoria artística focada no streetwear nacional.
        </p>
        <div class="flex items-center gap-3 text-zinc-400 text-lg">
          <a href="#" class="hover:text-orange-400 transition-colors"><i class="fab fa-instagram"></i></a>
          <a href="#" class="hover:text-orange-400 transition-colors"><i class="fab fa-tiktok"></i></a>
          <a href="#" class="hover:text-orange-400 transition-colors"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      
      <div>
        <h4 class="text-sm font-bold text-zinc-300 uppercase tracking-wider mb-4">Navegação</h4>
        <ul class="space-y-2 text-sm text-zinc-500">
          <li><a href="/" class="hover:text-orange-400 transition-colors">Início</a></li>
          <li><a href="#estampas" class="hover:text-orange-400 transition-colors">Estampas exclusivas</a></li>
          <li><a href="#promocoes" class="hover:text-orange-400 transition-colors">Black Drop / Promos</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-sm font-bold text-zinc-300 uppercase tracking-wider mb-4">Suporte & Termos</h4>
        <ul class="space-y-2 text-sm text-zinc-500">
          <li><a href="{{ route('support.faqs') }}" class="hover:text-orange-400 transition-colors">FAQs</a></li>
          <li><a href="{{ route('support.prazos') }}" class="hover:text-orange-400 transition-colors">Prazos de Entrega</a></li>
          <li><a href="{{ route('support.tamanhos') }}" class="hover:text-orange-400 transition-colors">Guia de Tamanhos</a></li>
          <li><a href="{{ route('support.trocas') }}" class="hover:text-orange-400 transition-colors">Política de Trocas</a></li>
          <li><a href="{{ route('support.envio') }}" class="hover:text-orange-400 transition-colors">Prazos de Envio</a></li>
          <li><a href="{{ route('support.termos') }}" class="hover:text-orange-400 transition-colors">Termos de Serviço</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-sm font-bold text-zinc-300 uppercase tracking-wider mb-4">Fique por dentro</h4>
        <p class="text-xs text-zinc-500 mb-3">Receba avisos de drops secretos direto no seu e-mail.</p>
        <form class="flex gap-2">
          <input type="email" placeholder="Seu melhor e-mail" class="bg-zinc-900 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-orange-500 flex-1">
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-black font-bold px-4 py-2 rounded-xl text-xs transition-colors">Join</button>
        </form>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 border-t border-zinc-900 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-zinc-600">
      <p>&copy; 2026 SKO-TRAP. Todos os direitos reservados.</p>
      <div class="flex gap-4">
        <span>Desenvolvido com <i class="fas fa-heart text-orange-500"></i> & Laravel</span>
      </div>
    </div>
  </footer>

  <script>
      window.storeWhatsappNumber = @json('258873182096');
      window.userData = @json([
          'nome' => Auth::user()?->nome ?? 'Cliente',
          'telefone' => Auth::user()?->telefone ?? ''
      ]);
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const track = document.getElementById('promoTrack');
      const prev = document.getElementById('promoPrev');
      const next = document.getElementById('promoNext');

      if (!track || !prev || !next) return;

      const slides = Array.from(track.children);
      const getVisibleCount = () => window.innerWidth < 768 ? 1 : 2;
      let currentIndex = 0;

      function updateCarousel() {
        const visibleCount = getVisibleCount();
        const maxIndex = Math.max(0, slides.length - visibleCount);
        currentIndex = Math.min(currentIndex, maxIndex);

        const slideWidth = slides[0].getBoundingClientRect().width + 20;
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

        prev.disabled = currentIndex === 0;
        next.disabled = currentIndex >= maxIndex;
      }

      prev.addEventListener('click', function () {
        if (currentIndex > 0) {
          currentIndex--;
          updateCarousel();
        }
      });

      next.addEventListener('click', function () {
        const maxIndex = Math.max(0, slides.length - getVisibleCount());
        if (currentIndex < maxIndex) {
          currentIndex++;
          updateCarousel();
        }
      });

      window.addEventListener('resize', updateCarousel);
      updateCarousel();
    });
  </script>
  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>