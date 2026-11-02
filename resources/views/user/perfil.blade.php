@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col items-center text-center">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl border border-orange-200 bg-orange-100 text-orange-600 shadow-lg shadow-orange-100">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-8 w-8" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.3"/>
                    <path d="M5 19c1.7-2.9 4-4.3 7-4.3 3 0 5.3 1.4 7 4.3"/>
                </svg>
            </div>
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Conta</p>
            <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Editar Meu Perfil</h2>
            <p class="mt-2 text-sm text-slate-600">Mantenha as suas informações pessoais e credenciais sempre atualizadas.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <svg class="h-5 w-5 flex-shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('sucesso'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('sucesso') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('user.perfil.update') }}" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="nome" class="mb-2 block text-sm font-medium text-slate-700">Nome</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $user->nome) }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>

                <div>
                    <label for="telefone" class="mb-2 block text-sm font-medium text-slate-700">Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>

                <div>
                    <label for="pais" class="mb-2 block text-sm font-medium text-slate-700">País</label>
                    <input type="text" id="pais" name="pais" value="{{ old('pais', $user->pais) }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>

                <div class="md:col-span-2">
                    <label for="cidade" class="mb-2 block text-sm font-medium text-slate-700">Cidade</label>
                    <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $user->cidade) }}" placeholder="Ex: Maputo" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>

                <div class="md:col-span-2 pt-4">
                    <div class="mb-5 border-t border-slate-200"></div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-slate-900">Segurança</h3>
                        <p class="mt-1 text-xs text-slate-500">Preencha apenas se quiser redefinir a sua palavra-passe.</p>
                    </div>
                </div>

                <div>
                    <label for="senha_atual" class="mb-2 block text-sm font-medium text-slate-700">Senha atual</label>
                    <input type="password" id="senha_atual" name="senha_atual" placeholder="Senha atual" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>

                <div>
                    <label for="senha_nova" class="mb-2 block text-sm font-medium text-slate-700">Nova senha</label>
                    <input type="password" id="senha_nova" name="senha_nova" placeholder="Mínimo 6 caracteres" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20">
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full rounded-xl bg-orange-500 px-4 py-3.5 text-sm font-semibold text-white transition hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-500/20">
                    Guardar Alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection