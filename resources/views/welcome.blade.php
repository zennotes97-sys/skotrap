<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="SKO-TRAP é uma marca premium de estampagem, especializada em camisetas, hoodies e bonés. Oferecemos estampas de alta qualidade, cores vibrantes e acabamento profissional para sua marca ou projeto.">
    <meta name="author" content="Rute Uamusse">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="Website SKO-TRAP | Estampagem Premium">
    <meta property="og:description" content="SKO-TRAP é uma marca premium de estampagem, especializada em camisetas, hoodies e bonés. Oferecemos estampas de alta qualidade, cores vibrantes e acabamento profissional para sua marca ou projeto.">
    <meta property="og:image" content="{{ asset('imagens/logo-SKO-TRAKP.png') }}">
  <title>SKO-TRAP | Estampagem Premium</title>
  
  <link rel="shortcut icon" href="{{ asset('imagens/logo-SKO-TRAKP.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    .progress-bar { position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg,#ff8c00,#ff6b35); width:0; z-index:99999; box-shadow:0 0 10px rgba(255,140,0,0.8); transition: width .3s ease, opacity .3s ease; display:none; opacity:0 }
    .progress-bar.active{ display:block; opacity:1 }
  </style>
</head>
<body class="bg-neutral-950 text-white overflow-x-hidden">

  <div class="progress-bar" id="progressBar"></div>

 <nav id="navbar" class="hero-bg fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent">
    <div id="navbar-container" class="max-w-7xl mx-auto px-4 sm:px-6 py-5 flex items-center justify-between transition-all duration-300">

      <div class="flex items-center gap-5">
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
        <a href="#" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-home"></i> Início</a>
        <a href="#servico" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-tshirt"></i> Serviços</a>
        <a href="#estampas" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-images"></i> Estampas</a>
        <a href="#sobre" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-info-circle"></i> Sobre</a>
        <a href="#contacto" class="flex items-center gap-2 hover:text-orange-400 transition-colors"><i class="fas fa-envelope"></i> Contacto</a>
      </div>

      <div class="hidden md:flex items-center gap-4">
        @auth
        <div class="relative group z-[9999]">
          <button class="px-5 py-2.5 bg-orange-50 text-black rounded-3xl font-semibold transition-all duration-300 flex items-center gap-3 hover:bg-orange-600">
            <i class="fas fa-user"></i> {{ auth()->user()->nome }}
               <span id="cartCountBadgeNav" class="hidden min-w-5 h-5 rounded-full bg-black text-[10px] font-bold text-orange-400 flex items-center justify-center px-1">0</span>
            <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
          </button>

          <div class="absolute right-0 top-full mt-2 w-48 bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[9999] pointer-events-none group-hover:pointer-events-auto">
            <a href="{{ route('user.dashboard') }}" class="block px-6 py-3 text-white hover:bg-zinc-800 rounded-t-2xl transition-colors flex items-center gap-2">
              <i class="fas fa-chart-line text-orange-500"></i> Meu Painel
            </a>
            <a href="{{ route('user.perfil') }}" class="block px-6 py-3 text-white hover:bg-zinc-800 transition-colors flex items-center gap-2 border-t border-zinc-800">
              <i class="fas fa-user-edit text-orange-500"></i> Perfil
            </a>
            <a href="{{ route('user.pedidos') }}" class="block px-6 py-3 text-white hover:bg-zinc-800 transition-colors flex items-center gap-2 border-t border-zinc-800">
              <i class="fas fa-shopping-bag text-orange-500"></i> Pedidos
                <span id="cartCountBadgeMenu" class="ml-auto hidden rounded-full bg-orange-500 px-2 py-0.5 text-[10px] font-bold text-black">0</span>
            </a>
            @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-white hover:bg-zinc-800 transition-colors flex items-center gap-2 border-t border-zinc-800">
              <i class="fas fa-crown text-orange-500"></i> Admin
            </a>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="block border-t border-zinc-800">
              @csrf
              <button type="submit" class="w-full text-left px-6 py-3 text-red-400 hover:bg-zinc-800 rounded-b-2xl transition-colors flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Sair
              </button>
            </form>
          </div>
        </div>
      @endauth

      @guest
      <a href="{{ route('login') }}" class="px-5 py-2.5 bg-transparent border-2 border-orange-500 text-orange-400 hover:bg-orange-500 hover:text-black rounded-3xl font-semibold transition-all duration-300 flex items-center gap-2">Login</a>
      <a href="{{ route('registro') }}" class="px-5 py-2.5 bg-orange-500 text-black hover:bg-orange-600 rounded-3xl font-semibold transition-all duration-300 flex items-center gap-2">Registro</a>
      @endguest
     </div>

      <button id="mobile-menu-btn" class="md:hidden text-white text-2xl focus:outline-none p-2">
        <i class="fas fa-bars"></i>
      </button>

    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-zinc-950 border-b border-zinc-800 px-6 py-4 space-y-4">
      <a href="#" class="block py-2 text-lg hover:text-orange-400"><i class="fas fa-home mr-2"></i> Início</a>
      <a href="#servico" class="block py-2 text-lg hover:text-orange-400"><i class="fas fa-tshirt mr-2"></i> Serviços</a>
      <a href="#estampas" class="block py-2 text-lg hover:text-orange-400"><i class="fas fa-images mr-2"></i> Estampas</a>
      <a href="#sobre" class="block py-2 text-lg hover:text-orange-400"><i class="fas fa-info-circle mr-2"></i> Sobre</a>
      <a href="#contacto" class="block py-2 text-lg hover:text-orange-400"><i class="fas fa-envelope mr-2"></i> Contacto</a>
      <hr class="border-zinc-800">
      <div class="flex flex-col gap-3 pt-2">
        @guest
        <a href="{{ route('login') }}" class="w-full text-center py-3 border border-orange-500 text-orange-400 rounded-xl">Login</a>
        <a href="{{ route('registro') }}" class="w-full text-center py-3 bg-orange-500 text-black font-semibold rounded-xl">Registro</a>
        @endguest
      </div>
    </div>
  </nav>

  <section class="hero-bg min-h-screen flex items-center relative pt-24 md:pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-12 md:gap-16 items-center w-full">
      
      <div class="hero-left text-center md:text-left">
        <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight mb-6">
          Sua marca<br>em <span class="text-orange-500">alta definição</span>
        </h2>
        
        <p class="text-gray-200 text-base sm:text-lg mb-8 md:mb-10 mx-auto md:mx-0 max-w-lg">
          Estampagem premium em camisetas, hoodies, bonés e muito mais. 
          Qualidade insana, cores vibrantes e acabamento profissional.
        </p>

        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
          <button class="w-full sm:w-auto px-8 py-4 bg-orange-50 hover:bg-orange-600 text-black font-bold rounded-2xl transition-all text-lg shadow-lg">
            Fazer Orçamento
          </button>
          <button class="w-full sm:w-auto px-8 py-4 border border-white/50 hover:border-orange-500 hover:text-orange-400 rounded-2xl transition-all">
            Ver Portfólio
          </button>
        </div>

        <div class="grid grid-cols-3 gap-4 sm:gap-8 mt-12 md:mt-16 border-t border-zinc-900 pt-8">
          <div>
            <h3 class="text-2xl sm:text-4xl font-bold text-orange-500">999+</h3>
            <p class="text-xs sm:text-sm text-gray-400">Peças/mês</p>
          </div>
          <div>
            <h3 class="text-2xl sm:text-4xl font-bold text-orange-500">98%</h3>
            <p class="text-xs sm:text-sm text-gray-400">Satisfação</p>
          </div>
          <div>
            <h3 class="text-2xl sm:text-4xl font-bold text-orange-500">24h</h3>
            <p class="text-xs sm:text-sm text-gray-400">Prototipagem</p>
          </div>
        </div>
      </div>

      <div class="hidden md:flex justify-end">
        <div class="bg-black/70 backdrop-blur-xl border border-orange-500/20 rounded-3xl p-9 w-full max-w-md shadow-2xl hover:shadow-orange-500/40 transition-all duration-500 hover:-translate-y-3">
          <div class="text-orange-400 text-sm tracking-[4px] mb-5">O QUE OFERECEMOS</div>
          <h3 id="rotating-text" class="text-4xl font-bold leading-tight">Perfeição em cada detalhe</h3>
          <div class="mt-6 text-gray-300 text-[17px]">De designs simples a artes complexas — nós entregamos perfeição em cada peça.</div>
        </div>
      </div>
    </div>
    
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 hidden lg:flex">
      <p class="text-xs text-gray-500 tracking-widest">ROLE PARA BAIXO</p>
      <div class="w-6 h-10 border border-orange-500/40 rounded-full flex items-center justify-center">
        <div class="w-1 h-3 bg-orange-500 rounded-full animate-bounce"></div>
      </div>
    </div>
  </section>
  
  <!-- SEÇÃO SERVIÇOS -->
  <section class="py-16 md:py-24 bg-black" id="servico">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-12 md:mb-16">
        <div class="inline-flex items-center gap-2 bg-orange-500/10 text-orange-400 px-5 py-2.5 rounded-full text-sm font-medium mb-4 border border-orange-500/20">
          <i class="fas fa-tshirt"></i> NOSSA ESPECIALIDADE
        </div>
        <h2 class="text-3xl sm:text-5xl font-bold mb-4 bg-gradient-to-r from-white via-orange-200 to-white bg-clip-text text-transparent">Serviços Premium</h2>
        <p class="text-gray-400 max-w-2xl mx-auto text-base sm:text-lg">Utilizamos as melhores tecnologias do mercado para entregar estampas de alta qualidade com durabilidade insana.</p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 md:grid-cols-2 md:gap-8">
        <!-- Card 1 -->
        <div class="group bg-zinc-900/80 backdrop-blur-xl border border-zinc-700/50 hover:border-orange-500/30 rounded-3xl p-6 md:p-8 overflow-hidden transition-all duration-500 hover:shadow-2xl relative">
          <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center mb-6 md:mb-8 shadow-orange-500/30"><i class="fas fa-print text-3xl md:text-4xl text-white"></i></div>
          <h3 class="text-xl md:text-2xl font-bold mb-3 text-white">Estampagem Digital DTG</h3>
          <p class="text-gray-400 mb-6 md:mb-8 text-sm md:text-base">Impressão direta em tecido com cores vibrantes e detalhes precisos. Ideal para fotos e artes complexas.</p>
          <a href="#" class="text-orange-400 font-semibold inline-flex items-center gap-2">Saiba mais <i class="fas fa-arrow-right text-xs"></i></a>
        </div>
           <!-- Card 2 -->
      <div class="group bg-zinc-900/80 backdrop-blur-xl border border-zinc-700/50 hover:border-orange-500/30 rounded-3xl p-8 overflow-hidden transition-all duration-500 hover:-translate-y-4 hover:shadow-2xl hover:shadow-orange-500/10 relative">
        <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/30">
          <i class="fas fa-film text-4xl text-white"></i>
        </div>
        <h3 class="text-2xl font-bold mb-3 text-white">DTF - Direct to Film</h3>
        <p class="text-gray-400 mb-8 leading-relaxed">
          Transferência de alta qualidade com excelente durabilidade em lavagens.
        </p>
        <a href="#" class="text-orange-400 hover:text-orange-300 flex items-center gap-2 text-sm font-semibold transition-colors group-hover:gap-3">
          Saiba mais
          <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
        </a>
      </div>
      <!-- Card 3 -->
      <div class="group bg-zinc-900/80 backdrop-blur-xl border border-zinc-700/50 hover:border-orange-500/30 rounded-3xl p-8 overflow-hidden transition-all duration-500 hover:-translate-y-4 hover:shadow-2xl hover:shadow-orange-500/10 relative">
        <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/30">
          <i class="fas fa-layer-group text-4xl text-white"></i>
        </div> 
        <h3 class="text-2xl font-bold mb-3 text-white">Serigrafia</h3>
        <p class="text-gray-400 mb-8 leading-relaxed">
          Técnica tradicional com excelente custo-benefício para grandes tiragens e cores sólidas.
        </p> 
        <a href="#" class="text-orange-400 hover:text-orange-300 flex items-center gap-2 text-sm font-semibold transition-colors group-hover:gap-3">
          Saiba mais
          <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
        </a>
      </div>
      </div>
    </div>
  </section>
<!-- SEÇÃO ESTAMPAS -->
<section id="estampas" class="py-24 bg-zinc-950">
<div class="max-w-7xl mx-auto px-6">
  <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-16 items-center">
    
    <!-- LADO ESQUERDO - Texto -->
    <div class="md:col-span-5 space-y-6">
      <div class="inline-flex items-center gap-2 bg-orange-500/10 text-orange-400 px-4 py-2 rounded-full text-sm font-medium">
        <i class="fas fa-images"></i>
        NOSSO TRABALHO
      </div>
      
      <h2 class="text-4xl sm:text-5xl font-bold leading-tight">
        Estampas que <span class="text-orange-500">contam sua história</span>
      </h2>
      
      <p class="text-gray-400 text-base sm:text-lg">
        Cada estampa é pensada e executada com o máximo de qualidade. 
        Utilizamos as melhores técnicas para garantir cores vibrantes, 
        durabilidade e um acabamento premium.
      </p>

      <a href="{{ route('estampas') }}" 
         class="inline-flex items-center gap-3 px-6 sm:px-8 py-3 sm:py-4 bg-orange-500 hover:bg-orange-600 text-black font-bold rounded-2xl transition-all text-base sm:text-lg">
        Ver Todas as Estampas
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <!-- LADO DIREITO - Carrossel -->
    <div class="md:col-span-7 relative group">
      <div id="carousel" 
           class="overflow-x-auto overflow-y-hidden scroll-smooth snap-x snap-mandatory flex gap-6 rounded-3xl">

        @forelse($estampas->take(4) as $estampa)
          <div class="min-w-[80%] sm:min-w-[calc(50%-10px)] snap-start">
            <div class="bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl cursor-pointer group"
                 data-id="{{ $estampa->id }}"
                 onclick="openImageModal(this)"
                 data-title="{{ e($estampa->nome) }}"
                 data-description="{{ e($estampa->descricao ?: 'Estampa exclusiva da coleção SKO-TRAP.') }}"
                 data-technique="{{ e($estampa->tecnica ?: 'Estampa Premium') }}"
                 data-product="{{ e($estampa->produto ?: 'Camiseta / Moletom') }}"
                 data-price="MZN {{ number_format($estampa->preco, 2, ',', '.') }}"
                 data-image="{{ $estampa->imagem ? asset('storage/' . $estampa->imagem) : asset('imagens/Animes.png') }}">
              <div class="relative overflow-hidden">
                <img src="{{ $estampa->imagem ? asset('storage/' . $estampa->imagem) : asset('imagens/Animes.png') }}"
                     class="w-full aspect-[4/4.5] object-cover group-hover:scale-110 transition-transform duration-300"
                     alt="{{ e($estampa->nome) }}">
                <div class="absolute top-4 right-4 bg-black/80 px-4 py-1 rounded-full text-xs font-medium tracking-wider">
                  {{ $estampa->tecnica ?: 'ESTAMPA' }}
                </div>
              </div>
              <div class="p-6 sm:p-8 bg-gradient-to-t from-black via-zinc-950 to-zinc-900">
                <h3 class="text-xl sm:text-2xl font-bold mb-2 text-white">{{ $estampa->nome }}</h3>
                <p class="text-gray-400 text-sm sm:text-base">{{ $estampa->produto ?: 'Camiseta / Moletom' }}</p>
                <p class="mt-3 text-sm font-semibold text-orange-400">MZN {{ number_format($estampa->preco, 2, ',', '.') }}</p>
              </div>
            </div>
          </div>
        @empty
          <div class="min-w-full rounded-2xl border border-dashed border-zinc-800 bg-zinc-950/60 p-8 text-center text-zinc-400">
            Nenhuma estampa cadastrada ainda.
          </div>
        @endforelse

      </div>

      <!-- Botões invisíveis até hover -->
      <button onclick="prevSlide()" 
              class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/70 hover:bg-orange-500 hover:text-black 
                     w-10 h-10 sm:w-14 sm:h-14 rounded-2xl flex items-center justify-center 
                     text-2xl sm:text-3xl transition-all shadow-lg opacity-0 group-hover:opacity-100">
        ←
      </button>
      
      <button onclick="nextSlide()" 
              class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/70 hover:bg-orange-500 hover:text-black 
                     w-10 h-10 sm:w-14 sm:h-14 rounded-2xl flex items-center justify-center 
                     text-2xl sm:text-3xl transition-all shadow-lg opacity-0 group-hover:opacity-100">
        →
      </button>
    </div>
  </div>
</div>
<script>
  (function(){
    var progressBar = document.getElementById('progressBar');
    var timer = null;
    function startProgress(){ if(!progressBar) return; progressBar.style.width='2%'; progressBar.classList.add('active'); clearInterval(timer); timer=setInterval(function(){ var current=parseFloat(progressBar.style.width)||0; var increment=Math.random()*8; var next=Math.min(90,current+increment); progressBar.style.width=next+'%'; if(next>=90) clearInterval(timer); },180); }
    function finishProgress(){ if(!progressBar) return; clearInterval(timer); progressBar.style.width='100%'; setTimeout(function(){ progressBar.classList.remove('active'); progressBar.style.width='0'; },300); }
    document.addEventListener('click', function(e){ var el = e.target.closest ? e.target.closest('a') : null; if(!el) return; var href = el.getAttribute('href')||''; var target = el.getAttribute('target'); if(target==='__blank' || target==='_blank' || href.indexOf('mailto:')===0 || href.indexOf('javascript:')===0) return; if(href.indexOf('#')===0) return; startProgress(); }, true);
    window.addEventListener('beforeunload', function(){ startProgress(); });
    window.addEventListener('pageshow', function(){ finishProgress(); });
    window.addEventListener('load', function(){ finishProgress(); });
  })();
</script>

  @php
    $servicosTecnicas = $servicosTecnicas ?? collect();

    $servicosFallback = collect([
        (object) [
            'id' => 1001,
            'nome' => 'Impressão Digital HD (DTG)',
            'descricao' => 'Processo de produção utilizando maquinário de alta tecnologia Direct-to-Garment.',
            'tecnica' => 'DTG',
            'produto' => 'Maquinário Industrial',
            'preco' => 0,
            'imagem' => 'imagens/Estapagem_8.jpeg',
        ],
        (object) [
            'id' => 1002,
            'nome' => 'Filme de Recorte & DTF Premium',
            'descricao' => 'Perfeito para logotipos, uniformes corporativos e designs esportivos que exigem alta vivacidade de cor. Trabalhamos com transfers de última geração que possuem elasticidade avançada, garantindo que a estampa acompanhe os movimentos da peça sem deformar ou desbotar.',
            'tecnica' => 'DTF',
            'produto' => 'Transfer Premium',
            'preco' => 0,
            'imagem' => 'imagens/Estapagem_5.jpeg',
        ],
    ]);

    if ($servicosTecnicas->count() < 2) {
        $servicosTecnicas = $servicosTecnicas->concat($servicosFallback)->take(2);
    }

    $servicoBloco1 = $servicosTecnicas->first();
    $servicoBloco2 = $servicosTecnicas->skip(1)->first();

    $servicoBloco1Image = str_starts_with(($servicoBloco1->imagem ?? ''), 'imagens/') ? asset($servicoBloco1->imagem) : asset('storage/' . ($servicoBloco1->imagem ?? ''));
    $servicoBloco2Image = str_starts_with(($servicoBloco2->imagem ?? ''), 'imagens/') ? asset($servicoBloco2->imagem) : asset('storage/' . ($servicoBloco2->imagem ?? ''));
  @endphp

  <!-- SEÇÃO SERVIÇOS E TÉCNICAS (CONTINUAÇÃO) -->
<section id="servicos-estamparia" class="pb-24 bg-zinc-950 text-white overflow-hidden">
  <div class="max-w-7xl mx-auto px-6">
    
    <!-- Linha Divisória Sutil -->
    <hr class="border-zinc-800 mb-24" />

    <div class="space-y-32">
      
      <!-- Bloco 1: Imagem na Esquerda, Texto na Direita -->
      <div class="grid md:grid-cols-12 gap-12 md:gap-20 items-center">
        <!-- Imagem -->
        <div class="md:col-span-6 order-2 md:order-1">
          <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-amber-600 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
           <!-- Exemplo de ajuste no Bloco 1 de Serviços -->
            <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-zinc-900 shadow-2xl cursor-pointer"
                onclick="openImageModal(this)"
                data-id="{{ $servicoBloco1->id ?? 1001 }}"
                data-title="{{ e($servicoBloco1->nome ?? 'Impressão Digital HD (DTG)') }}"
                data-description="{{ e($servicoBloco1->descricao ?? 'A tecnologia Direct-to-Garment (DTG) permite aplicar a tinta diretamente nas fibras do algodão. O resultado é um toque imperceptível, definição fotográfica em milhões de cores e uma durabilidade excepcional que não racha com as lavagens. Ideada para artes complexas e ricas em detalhes.') }}"
                data-technique="{{ e($servicoBloco1->tecnica ?? 'DTG') }}"
                data-product="{{ e($servicoBloco1->produto ?? 'Maquinário Industrial') }}"
                data-price="MZN {{ number_format($servicoBloco1->preco ?? 0, 2, ',', '.') }}">
            <img src="{{ $servicoBloco1Image }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" alt="{{ e($servicoBloco1->nome ?? 'Maquinário de Impressão Digital') }}">
            </div>
          </div>
        </div>

        <!-- Texto + Ícone -->
        <div class="md:col-span-6 order-1 md:order-2 space-y-6">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-orange-500/10 text-orange-400 text-2xl mb-2">
            <i class="fas fa-print"></i>
          </div>
          <h3 class="text-4xl font-bold tracking-tight">
            {{ $servicoBloco1->nome ?? 'Impressão Digital' }}
          </h3>
          <p class="text-gray-400 text-lg leading-relaxed">
            {{ $servicoBloco1->descricao ?? 'A tecnologia Direct-to-Garment (DTG) permite aplicar a tinta diretamente nas fibras do algodão. O resultado é um toque imperceptível, definição fotográfica em milhões de cores e uma durabilidade excepcional que não racha com as lavagens. Ideada para artes complexas e ricas em detalhes.' }}
          </p>
          <ul class="space-y-3 text-zinc-400 font-medium">
            <li class="flex items-center gap-3"><i class="fas fa-check text-orange-500"></i> Toque zero no tecido</li>
            <li class="flex items-center gap-3"><i class="fas fa-check text-orange-500"></i> Resolução de altíssima definição</li>
          </ul>
        </div>
      </div>

      <!-- Bloco 2: Texto na Esquerda, Imagem na Direita (Posições Invertidas) -->
      <div class="grid md:grid-cols-12 gap-12 md:gap-20 items-center">
        <!-- Texto + Ícone -->
        <div class="md:col-span-6 space-y-6">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-orange-500/10 text-orange-400 text-2xl mb-2">
            <i class="fas fa-tshirt"></i>
          </div>
          <h3 class="text-4xl font-bold tracking-tight">
            {{ $servicoBloco2->nome ?? 'Filme de Recorte & DTF Premium' }}
          </h3>
          <p class="text-gray-400 text-lg leading-relaxed">
            {{ $servicoBloco2->descricao ?? 'Perfeito para logotipos, uniformes corporativos e designs esportivos que exigem alta vivacidade de cor. Trabalhamos com transfers de última geração que possuem elasticidade avançada, garantindo que a estampa acompanhe os movimentos da peça sem deformar ou desbotar.' }}
          </p>
          <ul class="space-y-3 text-zinc-400 font-medium">
            <li class="flex items-center gap-3"><i class="fas fa-check text-orange-500"></i> Cores 100% sólidas e vibrantes</li>
            <li class="flex items-center gap-3"><i class="fas fa-check text-orange-500"></i> Excelente aderência em poliéster e algodão</li>
          </ul>
        </div>

        <!-- Imagem -->
        <div class="md:col-span-6">
          <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-amber-600 to-orange-500 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
            <div class="relative rounded-3xl overflow-hidden aspect-[4/3] bg-zinc-900 shadow-2xl" onclick="openImageModal(this)"
                data-id="{{ $servicoBloco2->id ?? 1002 }}"
                data-title="{{ e($servicoBloco2->nome ?? 'Filme de Recorte & DTF Premium') }}"
                data-description="{{ e($servicoBloco2->descricao ?? 'Perfeito para logotipos, uniformes corporativos e designs esportivos que exigem alta vivacidade de cor. Trabalhamos com transfers de última geração que possuem elasticidade avançada, garantindo que a estampa acompanhe os movimentos da peça sem deformar ou desbotar.') }}"
                data-technique="{{ e($servicoBloco2->tecnica ?? 'DTF') }}"
                data-product="{{ e($servicoBloco2->produto ?? 'Transfer Premium') }}"
                data-price="MZN {{ number_format($servicoBloco2->preco ?? 0, 2, ',', '.') }}">
              <img src="{{ $servicoBloco2Image }}" 
                   class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" 
                   alt="{{ e($servicoBloco2->nome ?? 'Aplicação de estampa transfer') }}">
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
</section>

<!-- SEÇÃO SOBRE NÓS -->
<section id="sobre" class="py-24 bg-zinc-950 text-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-12 gap-12 md:gap-20 items-center">
      
      <!-- LADO ESQUERDO: IMAGEM COM COMPOSIÇÃO DE DESIGN -->
      <div class="md:col-span-6 relative">
        <!-- Elemento Decorativo de Fundo -->
        <div class="absolute -top-4 -left-4 w-24 h-24 border-t-4 border-l-4 border-orange-500 rounded-tl-3xl opacity-40"></div>
        <div class="absolute -bottom-4 -right-4 w-24 h-24 border-b-4 border-r-4 border-orange-500 rounded-br-3xl opacity-40"></div>
        
        <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/4]">
          <img src="imagens/Sko-Trap-logo.jpg" 
               class="w-full h-full object-cover" 
               alt="Nossa Oficina / Processo Criativo">
          <!-- Overlay de Degradê -->
          <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>
        </div>
      </div>

      <!-- LADO DIREITO: TEXTO SOBRE A EMPRESA -->
      <div class="md:col-span-6 space-y-6" id="sobre">
        <div class="inline-flex items-center gap-2 bg-orange-500/10 text-orange-400 px-4 py-2 rounded-full text-sm font-medium">
          <i class="fas fa-info-circle"></i>
          QUEM SOMOS
        </div>
        
        <h2 class="text-5xl font-bold leading-tight">
          Paixão por estampar <br />
          <span class="text-orange-500">grandes ideias</span>
        </h2>
        
        <p class="text-gray-400 text-lg leading-relaxed">
          Nascemos com o propósito de transformar roupas em telas de expressão urbana e artística. Unimos a precisão do maquinário industrial de última geração ao cuidado do acabamento artesanal, garantindo que cada peça entregue seja uma obra de arte duradoura.
        </p>

        <p class="text-gray-400 text-lg leading-relaxed">
          Seja para a sua marca de roupas, fardamento corporativo ou um projeto autoral exclusivo, nós entregamos a melhor fidelidade de cor e resistência do mercado.
        </p>

        <!-- Estatísticas Rápidas -->
        <div class="grid grid-cols-2 gap-6 pt-6 border-t border-zinc-800">
          <div>
            <span class="block text-4xl font-extrabold text-orange-500">+50k</span>
            <span class="text-sm text-zinc-400">Peças Estampadas</span>
          </div>
          <div>
            <span class="block text-4xl font-extrabold text-orange-500">99.8%</span>
            <span class="text-sm text-zinc-400">Clientes Satisfeitos</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- SEÇÃO CONTACTO -->
<section id="contacto" class="py-24 bg-zinc-900/40 border-t border-zinc-900 text-white">
  <div class="max-w-7xl mx-auto px-6">
    
    <div class="grid md:grid-cols-12 gap-12 md:gap-20">
      
      <!-- LADO ESQUERDO: INFORMAÇÕES DE CONTACTO -->
      <div class="md:col-span-5 space-y-8">
        <div>
          <div class="inline-flex items-center gap-2 bg-orange-500/10 text-orange-400 px-4 py-2 rounded-full text-sm font-medium mb-6">
            <i class="fas fa-envelope"></i>
            CONEXÃO DIRETA
          </div>
          <h2 class="text-5xl font-bold mb-4">Vamos criar <br><span class="text-orange-500">algo gigante?</span></h2>
          <p class="text-gray-400 text-lg">
            Tem um projeto em mente ou precisa de um orçamento para a sua marca? Entre em contacto connosco agora mesmo. Resposta em até 24 horas.
          </p>
        </div>

        <div class="space-y-4">
          <!-- Card Telefone/Whats -->
          <a href="https://wa.me/258873182096" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-orange-500/50 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-400 flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-black transition-colors">
              <i class="fab fa-whatsapp"></i>
            </div>
            <div>
              <span class="block text-xs text-zinc-500 font-medium">WHATSAPP</span>
              <span class="text-zinc-200 font-semibold">+258 873 182 096</span>
            </div>
          </a>

          <!-- Card Email -->
          <a href="mailto:contato@suamarca.com" class="flex items-center gap-4 p-4 rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-orange-500/50 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-400 flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-black transition-colors">
              <i class="far fa-envelope"></i>
            </div>
            <div>
              <span class="block text-xs text-zinc-500 font-medium">EMAIL</span>
              <span class="text-zinc-200 font-semibold">Ibraimozuba@gmail.com</span>
            </div>
          </a>
        </div>
      </div>

      <!-- LADO DIREITO: FORMULÁRIO DE CONTACTO PREMIUM -->
      <div class="md:col-span-7">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contato.store') }}" method="POST" class="p-8 md:p-10 bg-zinc-900 rounded-3xl border border-zinc-800 shadow-2xl space-y-6">
          @csrf
          <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label for="nome" class="text-sm font-medium text-zinc-400">Seu Nome</label>
              <input id="nome" name="nome" type="text" value="{{ old('nome') }}" placeholder="John Doe" required
                     class="w-full px-5 py-4 bg-zinc-950 border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 transition-colors">
            </div>
            <div class="space-y-2">
              <label for="email" class="text-sm font-medium text-zinc-400">Seu Email</label>
              <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="john@exemplo.com" required
                     class="w-full px-5 py-4 bg-zinc-950 border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 transition-colors">
            </div>
          </div>

          <div class="space-y-2">
            <label for="assunto" class="text-sm font-medium text-zinc-400">Assunto / Tipo de Serviço</label>
            <select id="assunto" name="assunto" required class="w-full px-5 py-4 bg-zinc-950 border border-zinc-800 rounded-xl text-white focus:outline-none focus:border-orange-500 transition-colors appearance-none">
              <option value="" class="text-zinc-600">Selecione uma opção</option>
              <option value="Orçamento de Estamparia (DTG / DTF)" {{ old('assunto') == 'Orçamento de Estamparia (DTG / DTF)' ? 'selected' : '' }}>Orçamento de Estamparia (DTG / DTF)</option>
              <option value="Produção de Marca Própria (Private Label)" {{ old('assunto') == 'Produção de Marca Própria (Private Label)' ? 'selected' : '' }}>Produção de Marca Própria (Private Label)</option>
              <option value="Parcerias ou Outros Assuntos" {{ old('assunto') == 'Parcerias ou Outros Assuntos' ? 'selected' : '' }}>Parcerias ou Outros Assuntos</option>
            </select>
          </div>

          <div class="space-y-2">
            <label for="mensagem" class="text-sm font-medium text-zinc-400">Detalhes do Projeto</label>
            <textarea id="mensagem" name="mensagem" rows="4" placeholder="Conte-nos um pouco sobre a sua ideia, quantidade de peças..." required
                      class="w-full px-5 py-4 bg-zinc-950 border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 transition-colors resize-none">{{ old('mensagem') }}</textarea>
          </div>

          <button type="submit"
                  class="w-full py-4 bg-orange-500 hover:bg-orange-600 text-black font-bold rounded-xl transition-colors text-lg shadow-lg flex items-center justify-center gap-2">
            Enviar Mensagem
            <i class="fas fa-paper-plane text-sm"></i>
          </button>

        </form>
      </div>

    </div>
  </div>
</section>
<!-- RODAPÉ PREMIUM (FOOTER) -->
<footer class="bg-zinc-950 text-white border-t border-zinc-900 pt-20 pb-8 font-sans">
  <div class="max-w-7xl mx-auto px-6">
    
    <div class="grid md:grid-cols-12 gap-12 mb-16">
      
      <!-- COLUNA 1: LOGO E SOBRE -->
      <div class="md:col-span-4 space-y-6">
        <!-- Logo SKO-TRAP Estilizado -->
        <div class="flex items-center gap-3 group">
          <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-orange-500 transition-colors group-hover:border-orange-500/50">
            <!-- Ícone que remete à onda sonora da logo.jpeg -->
            <i class="fas fa-waveform-lines text-lg"></i>
          </div>
          <span class="text-2xl font-black tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-white via-zinc-400 to-white">
            SKO<span class="text-orange-500">-</span>TRAP
          </span>
        </div>
        
        <p class="text-gray-500 text-sm leading-relaxed max-w-sm">
          Elevando o conceito de estamparia urbana. Conectando a cultura das ruas à máxima qualidade técnica e acabamento premium.
        </p>
        
        <!-- Redes Sociais -->
        <div class="flex items-center gap-4 pt-2">
          <a href="#" class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-gray-400 hover:text-orange-500 hover:border-orange-500/30 transition-all">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-gray-400 hover:text-orange-500 hover:border-orange-500/30 transition-all">
            <i class="fab fa-tiktok"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-gray-400 hover:text-orange-500 hover:border-orange-500/30 transition-all">
            <i class="fab fa-facebook-f"></i>
          </a>
        </div>
      </div>

      <!-- COLUNA 2: NAVEGAÇÃO RÁPIDA -->
      <div class="md:col-span-2 space-y-4">
        <h4 class="text-sm font-bold tracking-wider text-orange-500 uppercase">Navegação</h4>
        <ul class="space-y-3 text-sm text-gray-400">
          <li><a href="#estampas" class="hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-zinc-600"></i> Estampas</a></li>
          <li><a href="#servicos-tecnicos" class="hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-zinc-600"></i> Serviços</a></li>
          <li><a href="#sobre" class="hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-zinc-600"></i> Sobre Nós</a></li>
          <li><a href="#contacto" class="hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-zinc-600"></i> Contacto</a></li>
        </ul>
      </div>

      <!-- COLUNA 3: AJUDA & SUPORTE -->
      <div class="md:col-span-2 space-y-4">
        <h4 class="text-sm font-bold tracking-wider text-orange-500 uppercase">Suporte</h4>
        <ul class="space-y-3 text-sm text-gray-400">
          <li><a href="{{ route('support.faqs') }}" class="hover:text-white transition-colors">FAQs</a></li>
          <li><a href="{{ route('support.prazos') }}" class="hover:text-white transition-colors">Prazos de Entrega</a></li>
          <li><a href="{{ route('support.envio') }}" class="hover:text-white transition-colors">Prazos de Envio</a></li>
          <li><a href="{{ route('support.tamanhos') }}" class="hover:text-white transition-colors">Guia de Tamanhos</a></li>
          <li><a href="{{ route('support.trocas') }}" class="hover:text-white transition-colors">Política de Trocas</a></li>
          <li><a href="{{ route('support.termos') }}" class="hover:text-white transition-colors">Termos de Serviço</a></li>
        </ul>
      </div>

      <!-- COLUNA 4: NEWSLETTER / DROPS -->
      <div class="md:col-span-4 space-y-4">
        <h4 class="text-sm font-bold tracking-wider text-orange-500 uppercase">Fique por dentro</h4>
        <p class="text-sm text-gray-500">
          Subscreva para receber notificações sobre novos drops de estampas, coleções exclusivas e promoções.
        </p>
        <form class="flex gap-2 pt-2">
          <input type="email" placeholder="Seu melhor email" 
                 class="w-full px-4 py-3 bg-zinc-900 border border-zinc-800 rounded-xl text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 transition-colors">
          <button type="submit" 
                  class="px-5 py-3 bg-orange-500 hover:bg-orange-600 text-black font-bold rounded-xl text-sm transition-colors shadow-lg">
            <i class="fas fa-paper-plane"></i>
          </button>
        </form>
      </div>

    </div>

    <!-- LINHA INFERIOR: COPYRIGHT & CRÉDITOS -->
    <div class="border-t border-zinc-900 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-600">
      <p>&copy; 2026 SKO-TRAP. Todos os direitos reservados.</p>
      <div class="flex items-center gap-6">
        <a href="#" class="hover:text-gray-400 transition-colors">Política de Privacidade</a>
        <a href="{{ route('support.termos') }}" class="hover:text-gray-400 transition-colors">Termos de Serviço</a>
      </div>
    </div>

  </div>
</footer>
{{-- Inclusão do script JavaScript via helper do Laravel --}}
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/85 backdrop-blur-sm p-4 overflow-y-auto" onclick="closeImageModal(event)">
  
  <div class="modal-content relative w-full max-w-6xl my-8 overflow-hidden rounded-3xl bg-zinc-950 shadow-2xl text-white transition-all duration-300" onclick="event.stopPropagation()">
    
    {{-- Botão Fechar Principal --}}
    <button id="modalCloseButton" type="button" onclick="closeImageModal()" class="absolute right-4 top-4 z-20 inline-flex h-11 w-11 items-center justify-center rounded-full border border-zinc-800 bg-zinc-900/80 backdrop-blur-sm text-zinc-300 transition hover:border-orange-500 hover:text-white">
      <i class="fas fa-times"></i>
    </button>

    {{-- Grid Dinâmico: Se adapta caso o painel de comentários esteja visível ou não --}}
    <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr]">
      
      {{-- Painel de Comentários --}}
      <aside id="commentPanel" class="hidden w-full lg:w-96 overflow-hidden border-b lg:border-b-0 lg:border-r border-zinc-800 bg-zinc-900 p-5 md:p-6 flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between gap-3 pb-4 border-b border-zinc-800">
            <div>
              <p class="text-xs uppercase tracking-widest text-zinc-500">Comentários</p>
              <h3 class="text-lg font-semibold text-white">Painel de Comentários</h3>
            </div>
            <button type="button" onclick="toggleCommentPanel()" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-zinc-800 text-zinc-400 transition hover:bg-orange-500 hover:text-black">
              <i class="fas fa-arrow-left lg:hidden"></i> {{-- Ícone muda no mobile para indicar recuo --}}
              <i class="fas fa-times hidden lg:block"></i>
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

      {{-- Conteúdo Principal do Produto/Estampa --}}
      <div class="p-6 md:p-8 flex flex-col justify-between">
        <div class="grid gap-6 md:grid-cols-2">
          
          {{-- Container da Imagem --}}
          <div class="relative bg-zinc-900 overflow-hidden rounded-2xl flex items-center justify-center min-h-[300px] max-h-[500px]">
            <img id="modalImage" src="" alt="Estampa" class="h-full w-full object-contain max-h-[500px]" />
          </div>
          
          {{-- Detalhes do Produto --}}
          <div class="flex flex-col justify-between space-y-6">
            <div class="space-y-3">
              <span id="modalTechniqueBadge" class="inline-flex rounded-full bg-orange-500/10 px-3 py-1 text-xs uppercase tracking-widest text-orange-300 font-medium"></span>
              <h2 id="modalTitle" class="text-2xl md:text-3xl font-bold tracking-tight text-white leading-tight"></h2>
              
              <div class="max-h-[180px] overflow-y-auto pr-2 text-sm leading-relaxed text-zinc-400 scrollbar-thin scrollbar-thumb-zinc-800">
                <p id="modalDescription"></p>
              </div>
            </div>

            {{-- Info Cards --}}
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

            {{-- Ações/Botões --}}
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
              
              <button id="makeOrderButton" type="Button" onclick="makeOrder()" class="w-full sm:w-auto sm:flex-1 inline-flex items-center justify-center gap-2 rounded-full bg-orange-500 px-6 py-3 text-sm font-semibold text-black transition hover:bg-orange-600 shadow-lg shadow-orange-500/10 active:scale-95">
                <i class="fas fa-shopping-cart"></i>
                Pedir agora
              </button>
            </div>
            <div id="cartMessage" class="mt-3 text-sm font-medium text-emerald-300 hidden"></div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

  <script>
      window.storeWhatsappNumber = @json('258873182096');
      window.userData = @json([
          'nome' => Auth::user()?->nome ?? 'Cliente',
          'telefone' => Auth::user()?->telefone ?? ''
      ]);
  </script>
  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>