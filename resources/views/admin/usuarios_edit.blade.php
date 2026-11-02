@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('admin.usuarios') }}" class="text-slate-400 transition-colors hover:text-orange-500">
                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
            <div>
                <p class="mb-1 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Clientes</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Editar Usuário</h1>
                <p class="mt-1 text-sm text-slate-600">Modifique as informações de <span class="font-semibold text-slate-900">{{ $usuario->nome }}</span>.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome', $usuario->nome) }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone', $usuario->telefone) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">País</label>
                        <input type="text" name="pais" value="{{ old('pais', $usuario->pais) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Cidade</label>
                        <input type="text" name="cidade" value="{{ old('cidade', $usuario->cidade) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Nível (Role)</label>
                        <select name="role" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                            <option value="usuario" @if(old('role', $usuario->role) == 'usuario') selected @endif>Usuário</option>
                            <option value="admin" @if(old('role', $usuario->role) == 'admin') selected @endif>Administrador</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                        <select name="ativo" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
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
</div>
@endsection