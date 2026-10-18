@extends('layouts.guest')

{{-- Seus cabeçalhos e rodapés gerais ficam isolados aqui --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-neutral-950 to-orange-950/40 py-12 px-4 sm:px-6 lg:px-8">
    <div class="relative bg-neutral-950/90 backdrop-blur-xl p-8 sm:p-10 rounded-3xl shadow-2xl shadow-orange-950/30 
                border border-yellow-400/40 
                ring-1 ring-yellow-400/20
                w-full max-w-2xl overflow-hidden">
        
        {{-- Brilho sutil de fundo --}}
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-orange-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl pointer-events-none"></div>
        
        {{-- Linha amarela decorativa superior --}}
        <div class="absolute top-0 left-6 right-6 h-px bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div>

        <div class="relative text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                Crie sua <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Conta</span>
            </h1>
            <p class="mt-2 text-sm text-neutral-400">Preencha os dados abaixo para começar na nossa plataforma</p>
        </div>

        {{-- Exibição de Erros Consolidada do Laravel --}}
        @if ($errors->any())
            <div class="relative bg-red-950/40 border border-red-500/40 text-red-200 p-4 rounded-2xl mb-6 text-sm flex items-start gap-3 backdrop-blur-sm">
                <svg class="h-5 w-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/registro') }}" method="POST" class="relative space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label for="nome" class="block text-sm font-medium text-neutral-300 mb-1.5">Nome Completo</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="Ex: João Silva">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-300 mb-1.5">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="nome@exemplo.com">
                </div>

                <div>
                    <label for="telefone" class="block text-sm font-medium text-neutral-300 mb-1.5">Telefone de Contato</label>
                    <input type="tel" id="telefone" name="telefone" value="{{ old('telefone') }}"
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="Ex: +351 912 345 678">
                </div>

                <div>
                    <label for="pais" class="block text-sm font-medium text-neutral-300 mb-1.5">País</label>
                    <input type="text" id="pais" name="pais" value="{{ old('pais') }}"
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="Ex: Portugal">
                </div>

                <div>
                    <label for="cidade" class="block text-sm font-medium text-neutral-300 mb-1.5">Cidade</label>
                    <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}"
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="Ex: Lisboa">
                </div>

                <div>
                    <label for="senha" class="block text-sm font-medium text-neutral-300 mb-1.5">Senha de Acesso</label>
                    <input type="password" id="senha" name="senha" required
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="Mínimo 6 caracteres">
                </div>

                <div>
                    <label for="confirmar_senha" class="block text-sm font-medium text-neutral-300 mb-1.5">Confirme sua Senha</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required
                        class="w-full px-4 py-3 border border-neutral-800 rounded-2xl bg-neutral-900/80 text-white text-sm
                               placeholder-neutral-500
                               focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/30
                               transition-all duration-200 hover:border-neutral-700"
                        placeholder="Repita a senha exatamente">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="group relative w-full overflow-hidden bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold py-3.5 px-4 rounded-2xl
                           hover:from-orange-500 hover:to-orange-400
                           active:scale-[0.98] transition-all duration-200
                           shadow-lg shadow-orange-600/25 hover:shadow-orange-500/40">
                    <span class="relative z-10">Finalizar Cadastro</span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </div>
        </form>

        <div class="relative text-center mt-8 pt-6 border-t border-neutral-800/80">
            <p class="text-sm text-neutral-400">
                Já faz parte da plataforma?
                <a href="{{ url('/login') }}" class="font-semibold text-orange-400 hover:text-orange-300 transition-colors duration-200">
                    Acesse sua conta aqui
                </a>
            </p>
        </div>
    </div>
</div>
@endsection