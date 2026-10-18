@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900">Editar Meu Perfil</h2>
        <p class="mt-2 text-sm text-neutral-500">Mantenha suas informações de contato e credenciais sempre atualizadas</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-950/50 border-l-4 border-red-500 text-red-200 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
            <svg class="h-5 w-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    @if (session('sucesso'))
        <div class="bg-green-950/50 border-l-4 border-green-500 text-green-200 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
            <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('sucesso') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('user.perfil.update') }}" class="bg-neutral-900 p-8 rounded-2xl shadow-xl border border-neutral-800 hover:border-orange-500/30 transition-all duration-300">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="nome" class="block text-sm font-medium text-neutral-300 mb-1.5">Nome</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome', $user->nome) }}" required class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-neutral-300 mb-1.5">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200">
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium text-neutral-300 mb-1.5">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}" class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200">
            </div>

            <div>
                <label for="pais" class="block text-sm font-medium text-neutral-300 mb-1.5">País</label>
                <input type="text" id="pais" name="pais" value="{{ old('pais', $user->pais) }}" class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200">
            </div>

            <div class="md:col-span-2">
                <label for="cidade" class="block text-sm font-medium text-neutral-300 mb-1.5">Cidade</label>
                <input 
                    type="text" id="cidade" name="cidade"
                    class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm placeholder-neutral-500 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200"
                    placeholder="Ex: Lisboa" value="{{ old('cidade', $user->cidade) }}">
            </div>

            <div class="md:col-span-2 pt-4 text-center">
                <div class="w-full border-t border-neutral-800 mb-6"></div>
                <h3 class="text-xl font-bold text-white mb-1">Segurança & Senha</h3>
                <p class="text-xs text-neutral-400">Preencha os campos abaixo apenas se desejar redefinir sua senha.</p>
            </div>

            <div>
                <label for="senha_atual" class="block text-sm font-medium text-neutral-300 mb-1.5">Senha Atual</label>
                <input 
                    type="password" id="senha_atual" name="senha_atual"
                    class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm placeholder-neutral-500 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200"
                    placeholder="Sua senha atual"
                >
            </div>

            <div>
                <label for="senha_nova" class="block text-sm font-medium text-neutral-300 mb-1.5">Nova Senha</label>
                <input 
                    type="password" id="senha_nova" name="senha_nova"
                    class="w-full px-4 py-2.5 border border-neutral-700 rounded-xl bg-neutral-800 text-white text-sm placeholder-neutral-500 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-200"
                    placeholder="Mínimo 6 caracteres"
                >
            </div>
        </div>

        <div class="pt-4">
            <button 
                type="submit" 
                class="w-full bg-orange-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-orange-500 focus:outline-none focus:ring-4 focus:ring-orange-500/20 active:scale-[0.99] transition-all duration-150 shadow-md shadow-orange-600/10"
            >
                Guardar Alterações
            </button>
        </div>
    </form>
</div>
@endsection