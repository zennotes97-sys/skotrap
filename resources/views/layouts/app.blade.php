<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'SKO-TRAP') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    html, body {
        height: 100%;
        overflow: hidden;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #2d2c2c !important;
        overflow-x: hidden;
    }
    /* Sua Barra de Progresso mantida */
    .progress-bar {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, #ff8c00, #ff6b35);
        width: 0;
        z-index: 9999;
        box-shadow: 0 0 10px rgba(255, 140, 0, 0.8);
        transition: width 0.3s ease, opacity 0.3s ease;
        display: none;
        opacity: 0;
    }
    .progress-bar.active {
        display: block;
        opacity: 1;
    }

    /* ==========================================================================
       CORREÇÃO: Ocultar barras de scroll e exibir apenas sob interação
       ========================================================================== */
    
    /* 1. Scrollbar do Conteúdo Principal (Oculta por padrão, exibe no hover) */
    main::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    main::-webkit-scrollbar-track {
        background: transparent; 
    }
    main::-webkit-scrollbar-thumb {
        background: transparent; /* Invisível quando estático */
        border-radius: 20px;
    }
    /* Exibe o indicador da barra apenas quando o mouse estiver em movimento sobre o container */
    main:hover::-webkit-scrollbar-thumb {
        background: #3f3f46; /* Zinc-700 */
        border: 2px solid transparent;
    }
    main::-webkit-scrollbar-thumb:hover {
        background: #f97316 !important; /* Laranja em foco direto */
    }

    /* 2. Scrollbar da Sidebar (Invisível por padrão, exibe no hover) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 10px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #27272a; /* Zinc-800 */
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #ea580c !important;
    }

    /* Suporte para Firefox (Fade nativo de barra de rolagem automática) */
    main {
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
        transition: scrollbar-color 0.3s ease;
    }
    main:hover {
        scrollbar-color: #3f3f46 transparent;
    }
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
        transition: scrollbar-color 0.3s ease;
    }
    .custom-scrollbar:hover {
        scrollbar-color: #27272a transparent;
    }

    @media (max-width: 767px) {
        #dashboard-sidebar.is-open {
            transform: translateX(0);
        }

        #dashboard-sidebar-overlay.is-open {
            display: block;
        }
    }
</style>
</head>
<body class="text-gray-100">
    <div class="progress-bar" id="progressBar"></div>

    <div class="flex h-screen bg-black text-gray-100 font-sans antialiased overflow-hidden">
        
    <aside id="dashboard-sidebar" class="fixed md:static inset-y-0 left-0 z-50 w-64 h-screen shrink-0 -translate-x-full md:translate-x-0 bg-zinc-900 grid grid-rows-[auto_1fr_auto] overflow-hidden transition-transform duration-300 ease-out">
  
            <!-- Cabeçalho -->
            <div class="p-6 border-b border-zinc-900 bg-zinc-900/20">
                <div class="flex items-center gap-3 mb-3">
                <div class="flex items-end gap-[3px] h-5 w-5 justify-center">
                    <div class="w-[3px] bg-orange-500 rounded-full animate-bounce" style="animation-duration: 0.8s; height: 60%;"></div>
                    <div class="w-[3px] bg-orange-500 rounded-full animate-bounce" style="animation-duration: 1.1s; height: 100%;"></div>
                    <div class="w-[3px] bg-orange-500 rounded-full animate-bounce" style="animation-duration: 0.6s; height: 40%;"></div>
                </div>
                <h2 class="text-xl font-black tracking-widest text-white">
                    SKO<span class="text-orange-500">-</span>TRAP
                </h2>
                </div>
                <div class="flex items-center justify-between mt-4">
                <span class="text-xs font-medium text-zinc-400 truncate max-w-[120px]">
                    <i class="far fa-user mr-1.5 text-zinc-600"></i>{{ Auth::user()->nome ?? 'Usuário' }}
                </span>
                @if(Auth::user() && Auth::user()->role === 'admin')
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-orange-500 text-black tracking-wide shadow-[0_0_15px_rgba(249,115,22,0.4)]">
                    ADMIN
                </span>
                @endif
                </div>
            </div>

            <!-- Menu rolável -->
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto custom-scrollbar min-h-0">
                @if(request()->is('admin*'))
                <a href="{{ route('home') }}" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/50 transition-all">
                        <i class="fas fa-home text-base w-5 text-zinc-600 group-hover:text-orange-400"></i>
                        <span>Início</span>
                    </a>
                    <a href="/admin/dashboard" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/dashboard') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-chart-line text-base w-5 {{ request()->is('admin/dashboard') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="/estampas" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/estampas') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-image text-base w-5 {{ request()->is('admin/estampas') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Estampas</span>
                    </a>

                    <a href="/admin/usuarios" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/usuarios') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-users text-base w-5 {{ request()->is('admin/usuarios') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Usuários</span>
                    </a>
                    <a href="/admin/pedidos" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/pedidos') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-shopping-bag text-base w-5 {{ request()->is('admin/pedidos') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Pedidos</span>
                    </a>
                    <a href="/admin/compras" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/compras') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-chart-bar text-base w-5 {{ request()->is('admin/compras') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Compras</span>
                    </a>
                   
                    <a href="/admin/produtos" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/produtos') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-tshirt text-base w-5 {{ request()->is('admin/produtos') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Produtos</span>
                    </a>
                    <a href="/admin/promocoes" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/promocoes') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-tags text-base w-5 {{ request()->is('admin/promocoes') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Promoções</span>
                    </a>
                    <a href="/admin/log" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/log') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-file-alt text-base w-5 {{ request()->is('admin/log') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Log de Atividades</span>
                    </a>
                    <a href="/admin/configuracoes" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/configuracoes') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-cogs text-base w-5 {{ request()->is('admin/configuracoes') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Configurações</span>
                    </a>
                    <a href="/admin/relatorios" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/relatorios') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-chart-pie text-base w-5 {{ request()->is('admin/relatorios') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Relatórios</span>
                    </a>

               @else
                    <a href="{{ route('home') }}" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-zinc-400 hover:text-white hover:bg-zinc-900/50 transition-all">
                        <i class="fas fa-home text-base w-5 text-zinc-600 group-hover:text-orange-400"></i>
                        <span>Início</span>
                    </a>

                    <a href="{{ route('user.dashboard') }}" 
                       class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('user.dashboard*') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-chart-line text-base w-5 {{ request()->routeIs('user.dashboard*') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Dashboard</span>
                    </a>
                     
 <a href="/estampas" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('admin/estampas') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-image text-base w-5 {{ request()->is('admin/estampas') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Estampas</span>
                    </a>
                    <a href="{{ route('user.pedidos') }}" 
                       class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('user.pedidos*') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-shopping-bag text-base w-5 {{ request()->routeIs('user.pedidos*') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Meus Pedidos</span>
                        <span id="cartCountBadge" class="ml-auto hidden rounded-full bg-orange-500 px-2 py-0.5 text-[10px] font-bold text-black">0</span>
                    </a>

                    <a href="/user/compras" 
                       class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('user/compras*') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-credit-card text-base w-5 {{ request()->is('user/compras*') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Minhas Compras</span>
                    </a>

                  

                    <a href="{{ route('user.perfil') }}" 
                       class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('user.perfil*') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-user text-base w-5 {{ request()->routeIs('user.perfil*') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Perfil</span>
                    </a>

                    <a href="/user/contato" 
                       class="group flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('user/contato*') ? 'bg-zinc-900 text-white border-l-2 border-orange-500 pl-[14px]' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/50' }}">
                        <i class="fas fa-headset text-base w-5 {{ request()->is('user/contato*') ? 'text-orange-500' : 'text-zinc-600 group-hover:text-orange-400' }}"></i>
                        <span>Contato</span>
                    </a>
                @endif
            </nav>

             <!-- Rodapé fixo -->
            <div class="p-4 border-t border-zinc-900 bg-zinc-900 space-y-1.5">
                <a href="/" class="group flex items-center gap-3 px-4 py-2.5 text-xs font-semibold text-zinc-500 hover:text-white hover:bg-zinc-900 rounded-lg transition-all">
                <i class="fas fa-arrow-left text-sm text-zinc-600 group-hover:text-orange-500 w-5"></i>
                <span>Voltar ao Site</span>
                </a>
                <form action="/logout" method="POST" id="logout-form" class="hidden">@csrf</form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="group flex items-center gap-3 px-4 py-2.5 text-xs font-semibold text-rose-500 hover:text-white hover:bg-rose-950/20 border border-rose-500/10 hover:border-rose-500/30 rounded-lg transition-all">
                <i class="fas fa-sign-out-alt text-sm text-rose-500/80 w-5"></i>
                <span>Terminar Sessão</span>
                </a>
            </div>

            </aside>
            <div id="dashboard-sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black/60 md:hidden" aria-hidden="true"></div>
            <div class="flex-1 flex flex-col h-screen bg-black min-w-0 overflow-hidden">
            <header class="h-16 bg-zinc-900 border-b border-zinc-900 px-4 sm:px-8 flex justify-between items-center shrink-0">
                <div class="flex items-center gap-2">
                    <button id="dashboard-menu-btn" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-zinc-300 hover:bg-zinc-800 hover:text-orange-400 transition-colors md:hidden" aria-label="Abrir menu" title="Abrir menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="text-xs font-semibold bg-zinc-900 text-orange-500 px-2.5 py-1 rounded-md border border-zinc-800 tracking-wider uppercase">
                        {{ request()->is('admin*') ? 'Ambiente Admin' : 'Área Cliente' }}
                    </span>
                </div>
                <div class="flex items-center gap-4 text-xs font-medium text-gray-500">
                    <span class="flex items-center gap-1.5"><i class="far fa-calendar"></i> {{ date('d/m/Y') }}</span>
                    <span class="text-zinc-800">•</span>
                    <span class="flex items-center gap-1.5"><i class="far fa-clock"></i> {{ date('H:i') }}</span>
                </div>
            </header>

           <main class="flex-1 overflow-y-auto overflow-x-hidden bg-zinc-50 text-zinc-900 relative min-h-0">
                
                <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-orange-500/10 rounded-full blur-[150px] pointer-events-none"></div>
                
                <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-white rounded-full blur-[100px] pointer-events-none shadow-[0_0_50px_rgba(255,255,255,0.8)]"></div>

                <div class="p-8 relative z-10 bg-gradient-to-br from-white via-zinc-100/50 to-zinc-200/50 min-h-full">
                    @yield('content')
                </div>
                <footer class="text-white text-center py-6 bg-zinc-900 border-t border-zinc-900 shrink-0">
                <p class="text-gray-400">&copy; {{ date('Y') }} SKO-TRAP - Estampagem Premium - Todos os direitos reservados</p>
            </footer>
            </main>

            
        </div>
        
    </div>
        <script src="{{ asset('js/script.js') }}"></script>

    <script>
        const dashboardSidebar = document.getElementById('dashboard-sidebar');
        const dashboardSidebarOverlay = document.getElementById('dashboard-sidebar-overlay');
        const dashboardMenuButton = document.getElementById('dashboard-menu-btn');

        function closeDashboardSidebar() {
            if (!dashboardSidebar || !dashboardSidebarOverlay) return;
            dashboardSidebar.classList.remove('is-open');
            dashboardSidebarOverlay.classList.remove('is-open');
            dashboardMenuButton?.querySelector('i')?.classList.replace('fa-xmark', 'fa-bars');
        }

        function toggleDashboardSidebar() {
            if (!dashboardSidebar || !dashboardSidebarOverlay) return;
            const isOpen = dashboardSidebar.classList.toggle('is-open');
            dashboardSidebarOverlay.classList.toggle('is-open', isOpen);
            dashboardMenuButton?.querySelector('i')?.classList.toggle('fa-bars', !isOpen);
            dashboardMenuButton?.querySelector('i')?.classList.toggle('fa-xmark', isOpen);
        }

        dashboardMenuButton?.addEventListener('click', toggleDashboardSidebar);
        dashboardSidebarOverlay?.addEventListener('click', closeDashboardSidebar);
        dashboardSidebar?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeDashboardSidebar);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) closeDashboardSidebar();
        });

        window.storeWhatsappNumber = @json('258873182096');
        window.userData = @json([
            'nome' => Auth::user()?->nome ?? 'Cliente',
            'telefone' => Auth::user()?->telefone ?? ''
        ]);

        (function(){
            var progressBar = document.getElementById('progressBar');
            var timer = null;

            function startProgress() {
                if(!progressBar) return;
                progressBar.style.width = '2%';
                progressBar.classList.add('active');
                clearInterval(timer);
                timer = setInterval(function(){
                    var current = parseFloat(progressBar.style.width) || 0;
                    var increment = Math.random() * 8;
                    var next = Math.min(90, current + increment);
                    progressBar.style.width = next + '%';
                    if(next >= 90) {
                        clearInterval(timer);
                    }
                }, 180);
            }

            function finishProgress() {
                if(!progressBar) return;
                clearInterval(timer);
                progressBar.style.width = '100%';
                setTimeout(function(){
                    progressBar.classList.remove('active');
                    progressBar.style.width = '0';
                }, 300);
            }

            // Intercept link clicks to show the progress bar
            document.addEventListener('click', function(e){
                var el = e.target.closest ? e.target.closest('a') : null;
                if(!el) return;
                var href = el.getAttribute('href') || '';
                var target = el.getAttribute('target');
                // Ignore external/new-tab and anchors
                if(target === '_blank' || href.indexOf('mailto:') === 0 || href.indexOf('javascript:') === 0) return;
                if(href.indexOf('#') === 0) return;
                // Start progress for same-origin navigations
                startProgress();
                // let navigation proceed
            }, true);

            // Start on beforeunload (fallback) and finish on load/pageshow
            window.addEventListener('beforeunload', function(){ startProgress(); });
            window.addEventListener('pageshow', function(){ finishProgress(); });
            window.addEventListener('load', function(){ finishProgress(); });
        })();
    </script>
</body>
</html>