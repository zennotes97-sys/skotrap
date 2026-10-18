@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Usuários</h1>
            <p class="text-sm text-zinc-500 mt-2">Gerencie todos os usuários cadastrados na plataforma.</p>
        </div>
        <div>
            <span class="text-sm text-zinc-500">Total de usuários</span>
            <p class="text-3xl font-semibold text-orange-500 mt-1">{{ $usuarios->total() }}</p>
        </div>
    </div>

    {{-- Feedback Alerts --}}
    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-visible"> {{-- Mudado para overflow-visible para o dropdown aparecer --}}
        <table class="min-w-full divide-y divide-zinc-200">
            <thead class="bg-zinc-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Nome</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Contato</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Localização</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Membro Desde</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-zinc-200">
                @foreach($usuarios as $usuario)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-zinc-900">{{ $usuario->nome }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-zinc-900">{{ $usuario->email }}</div>
                            <div class="text-xs text-zinc-500">{{ $usuario->telefone ?? 'Sem telefone' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                            {{ $usuario->cidade ?? 'Cidade não informada' }}, {{ $usuario->pais ?? 'País não informado' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                            {{ \Carbon\Carbon::parse($usuario->data_criacao)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                             <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $usuario->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                            {{-- Menu Dropdown Nativo com HTML5 <details> --}}
                            <details class="inline-block text-left list-none sticky">
                                <summary class="list-none cursor-pointer text-zinc-400 hover:text-zinc-600 p-1 rounded-full hover:bg-zinc-100 transition focus:outline-none inline-flex items-center justify-center [&::-webkit-details-marker]:hidden">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5?" />
                                    </svg>
                                </summary>

                                <div class="absolute right-0 mt-1 w-36 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-50 py-1 divide-y divide-zinc-100 origin-top-right">
                                    <div class="py-1">
                                        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="flex items-center px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900">
                                            Editar
                                        </a>
                                    </div>
                                    <div class="py-1">
                                        <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este usuário?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                Deletar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </details>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $usuarios->links() }}
    </div>
</div>
@endsection