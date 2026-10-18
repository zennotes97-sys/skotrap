@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen max-w-3xl">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.usuarios') }}" class="text-zinc-400 hover:text-orange-500 transition-colors">
            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Editar Usuário</h1>
            <p class="text-sm text-zinc-500 mt-1">Modifique as informações de <span class="font-semibold">{{ $usuario->nome }}</span>.</p>
        </div>
    </div>

    {{-- Feedback Alerts --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 border border-red-200 rounded-lg px-4 py-3 mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário de Edição --}}
    <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
        <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Nome</label>
                    <input type="text" name="nome" value="{{ old('nome', $usuario->nome) }}" required class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Telefone</label>
                    <input type="text" name="telefone" value="{{ old('telefone', $usuario->telefone) }}" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">País</label>
                    <input type="text" name="pais" value="{{ old('pais', $usuario->pais) }}" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Cidade</label>
                    <input type="text" name="cidade" value="{{ old('cidade', $usuario->cidade) }}" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Nível (Role)</label>
                    <select name="role" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                        <option value="usuario" @if(old('role', $usuario->role) == 'usuario') selected @endif>Usuário</option>
                        <option value="admin" @if(old('role', $usuario->role) == 'admin') selected @endif>Administrador</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-2">Status</label>
                    <select name="ativo" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                        <option value="1" @if(old('ativo', $usuario->ativo) == 1) selected @endif>Ativo</option>
                        <option value="0" @if(old('ativo', $usuario->ativo) == 0) selected @endif>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </section>
</div>
@endsection