@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Clientes</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Usuários</h1>
                <p class="mt-2 text-sm text-slate-600">Gerencie todos os usuários cadastrados na plataforma.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
                <span class="text-sm text-slate-500">Total de usuários</span>
                <p class="mt-1 text-3xl font-extrabold text-orange-600">{{ $usuarios->total() }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <form method="GET" action="{{ route('admin.usuarios') }}" class="grid gap-3 md:grid-cols-[2fr_180px_180px_140px_auto]">
                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Pesquisa</span>
                    <input type="text" id="live-user-search" name="search" value="{{ request('search') }}" placeholder="Nome, email ou telefone" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                </label>

                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Perfil</span>
                    <select name="role" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        <option value="">Todos</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="usuario" {{ request('role') === 'usuario' ? 'selected' : '' }}>Usuário</option>
                    </select>
                </label>

                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Status</span>
                    <select name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        <option value="">Todos</option>
                        <option value="ativo" {{ request('status') === 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ request('status') === 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </label>

                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Items</span>
                    <select name="per_page" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                        <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </label>

                <div class="flex items-end gap-2">
                    <button type="submit" class="inline-flex h-[42px] items-center justify-center rounded-2xl bg-orange-600 px-4 text-sm font-semibold text-white transition hover:bg-orange-500">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.usuarios') }}" class="inline-flex h-[42px] items-center justify-center rounded-2xl border border-slate-200 bg-white px-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Limpar
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Nome</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Contato</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Localização</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Membro Desde</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-slate-500">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($usuarios as $usuario)
                        <tr data-user-row data-search="{{ strtolower(($usuario->nome ?? '') . ' ' . ($usuario->email ?? '') . ' ' . ($usuario->telefone ?? '') . ' ' . ($usuario->role ?? '') . ' ' . ($usuario->cidade ?? '') . ' ' . ($usuario->pais ?? '')) }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-900">{{ $usuario->nome }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $usuario->email }}</div>
                                <div class="text-xs text-slate-500">{{ $usuario->telefone ?? 'Sem telefone' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $usuario->cidade ?? 'Cidade não informada' }}, {{ $usuario->pais ?? 'País não informado' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ \Carbon\Carbon::parse($usuario->data_criacao)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $usuario->ativo ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td class="relative px-6 py-4 text-right text-sm font-medium">
                                <details class="inline-block list-none text-left">
                                    <summary class="inline-flex cursor-pointer list-none items-center justify-center rounded-full p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none [&::-webkit-details-marker]:hidden">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                        </svg>
                                    </summary>

                                    <div class="absolute right-0 z-50 mt-1 w-36 origin-top-right divide-y divide-slate-100 rounded-xl bg-white py-1 shadow-lg ring-1 ring-slate-200">
                                        <div class="py-1">
                                            <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="flex items-center px-4 py-2 text-left text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900">Editar</a>
                                        </div>
                                        <div class="py-1">
                                            <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este usuário?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex w-full items-center px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50">Deletar</button>
                                            </form>
                                        </div>
                                    </div>
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr id="users-empty-state">
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-2 text-slate-500">
                                    <svg class="h-10 w-10 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.75A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 18.75V7.5A2.25 2.25 0 0 1 8.25 5.25h7.5A2.25 2.25 0 0 1 18 7.5v11.25Zm-9-9.75h6M9 12h6M9 15h4"/>
                                    </svg>
                                    <p class="text-base font-medium text-slate-600">Nenhum usuário encontrado.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $usuarios->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('live-user-search');
        const rows = Array.from(document.querySelectorAll('[data-user-row]'));
        const emptyState = document.getElementById('users-empty-state');

        function applyLiveFilter(value) {
            const term = value.trim().toLowerCase();
            let visibleRows = 0;

            rows.forEach((row) => {
                const searchText = (row.dataset.search || '').toLowerCase();
                const match = searchText.includes(term);
                row.classList.toggle('hidden', !match);
                if (match) visibleRows++;
            });

            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleRows > 0 || term === '');
            }
        }

        if (input) {
            input.addEventListener('input', function () {
                applyLiveFilter(this.value);
            });
        }
    });
</script>
@endsection