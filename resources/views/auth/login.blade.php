@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-neutral-950 to-orange-950/40 py-12 px-4 sm:px-6 lg:px-8">
    <div class="relative bg-neutral-950/90 backdrop-blur-xl p-8 sm:p-10 rounded-3xl shadow-2xl shadow-orange-950/30 
                border border-yellow-400/40 
                ring-1 ring-yellow-400/20
                w-full max-w-md overflow-hidden">
        
        {{-- Brilhos sutis de fundo --}}
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-orange-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl pointer-events-none"></div>
        
        {{-- Linha amarela decorativa no topo --}}
        <div class="absolute top-0 left-6 right-6 h-px bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div>

        <div class="relative text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                Seja <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">bem-vindo</span>
            </h1>
            <p class="mt-2 text-sm text-neutral-400">Insira suas credenciais para acessar sua conta</p>
        </div>
        
        {{-- Alerta de Sucesso vindo do redirecionamento do Registro --}}
        @if (session('sucesso'))
            <div class="relative bg-emerald-950/40 border border-emerald-500/40 text-emerald-200 p-4 rounded-2xl mb-6 text-sm flex items-start gap-3 backdrop-blur-sm">
                <svg class="h-5 w-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('sucesso') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="relative bg-red-950/40 border border-red-500/40 text-red-200 p-4 rounded-2xl mb-6 text-sm flex items-start gap-3 backdrop-blur-sm">
                <svg class="h-5 w-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="relative space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-neutral-300 mb-1.5">Endereço de E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                           placeholder-neutral-500
                           focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                           transition-all duration-200 hover:border-neutral-700"
                    placeholder="nome@exemplo.com">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="senha" class="block text-sm font-medium text-neutral-300">Sua Senha</label>
                    <a href="#" class="text-xs font-semibold text-orange-400 hover:text-orange-300 transition-colors duration-200">
                        Esqueceu a senha?
                    </a>
                </div>
                <input type="password" id="senha" name="senha" required
                    class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                           placeholder-neutral-500
                           focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                           transition-all duration-200 hover:border-neutral-700"
                    placeholder="••••••••">
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="group relative w-full overflow-hidden bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold py-3.5 px-4 rounded-2xl
                           hover:from-orange-500 hover:to-orange-400
                           active:scale-[0.98] transition-all duration-200
                           shadow-lg shadow-orange-600/25 hover:shadow-orange-500/40">
                    <span class="relative z-10">Entrar na Conta</span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </div>
        </form>

        <div class="relative text-center mt-8 pt-6 border-t border-neutral-800/80">
            <p class="text-sm text-neutral-400">
                Novo por aqui? 
                <a href="{{ url('/registro') }}" class="font-semibold text-orange-400 hover:text-orange-300 transition-colors duration-200">
                    Crie uma conta gratuitamente
                </a>
            </p>
        </div>
    </div>
</div>
@endsection