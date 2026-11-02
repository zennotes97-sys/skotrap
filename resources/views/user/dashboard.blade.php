@extends('layouts.app')
@section('title', 'Painel do Usuário')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <div class="mb-8 flex items-center justify-between gap-4 flex-wrap">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600 shadow-sm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5" aria-hidden="true">
                            <path d="M4 12.5V7.8A2.8 2.8 0 0 1 6.8 5h10.4A2.8 2.8 0 0 1 20 7.8v4.7"/>
                            <path d="M4 15.5c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-1.2c0-1.2-1-2.2-2.2-2.2H6.2A2.2 2.2 0 0 0 4 14.3v1.2Z"/>
                            <circle cx="12" cy="12" r="2.2"/>
                        </svg>
                    </span>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-orange-600">Área do cliente</p>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-950">
                    Bem-vindo de volta, <span class="text-orange-600">{{ $user->nome }}</span>
                </h1>
                <p class="text-sm text-slate-600 mt-2">Acompanhe os seus pedidos, compras e dados de contacto em tempo real.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('user.compras') }}" class="px-4 py-2.5 border border-slate-200 bg-white text-slate-700 hover:bg-slate-100 rounded-xl text-sm font-semibold transition-all">
                    <i class="fas fa-box mr-2"></i>Minhas Compras
                </a>
                <a href="{{ route('user.perfil') }}" class="px-5 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl text-sm transition-colors shadow-sm flex items-center gap-2">
                    <i class="fas fa-user-edit text-xs"></i>
                    Editar Perfil
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md hover:border-orange-200 transition-all flex flex-col justify-between group">
                <div>
                    <h2 class="text-xs font-semibold mb-2 text-slate-500 uppercase tracking-wider">Pedidos</h2>
                    <p class="text-4xl font-extrabold text-slate-950 mb-5">{{ $total_pedidos }}</p>
                </div>
                <a href="{{ route('user.pedidos') }}" class="text-orange-600 group-hover:text-orange-700 text-xs font-semibold inline-flex items-center gap-1.5 transition-colors">
                    Ver detalhes <span class="text-base group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md hover:border-orange-200 transition-all flex flex-col justify-between group">
                <div>
                    <h2 class="text-xs font-semibold mb-2 text-slate-500 uppercase tracking-wider">Compras</h2>
                    <p class="text-4xl font-extrabold text-slate-950 mb-5">{{ $total_compras }}</p>
                </div>
                <a href="{{ route('user.compras') }}" class="text-orange-600 group-hover:text-orange-700 text-xs font-semibold inline-flex items-center gap-1.5 transition-colors">
                    Ver detalhes <span class="text-base group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md hover:border-orange-200 transition-all flex flex-col justify-between">
                <div>
                    <h2 class="text-xs font-semibold mb-2 text-slate-500 uppercase tracking-wider">Total gasto</h2>
                    <p class="text-3xl font-extrabold text-orange-600 mb-5">
                        MZN {{ number_format($total_gasto, 2, ',', '.') }}
                    </p>
                </div>
                <span class="text-xs text-slate-500 font-medium">Valor acumulado real</span>
            </div>

            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm hover:shadow-md hover:border-orange-200 transition-all flex flex-col justify-between group">
                <div>
                    <h2 class="text-xs font-semibold mb-2 text-slate-500 uppercase tracking-wider">Mensagens</h2>
                    <p class="text-4xl font-extrabold text-slate-950 mb-5">{{ $mensagens_nao_lidas }}</p>
                </div>
                <a href="{{ route('user.mensagens') }}" class="text-orange-600 group-hover:text-orange-700 text-xs font-semibold inline-flex items-center gap-1.5 transition-colors">
                    Ler mensagens <span class="text-base group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-7 xl:col-span-1">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-5 mb-6">
                    <div class="w-12 h-12 rounded-full bg-orange-50 border border-orange-100 flex items-center justify-center text-orange-600 text-xl shadow-inner">
                        <i class="fas fa-user text-orange-500"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-950">Perfil</h2>
                        <p class="text-xs text-slate-500">Dados pessoais e contacto</p>
                    </div>
                </div>

                <div class="space-y-5 text-sm">
                    <div class="flex items-center justify-between gap-2 border-b border-slate-50 pb-3">
                        <span class="text-slate-500 font-medium">Nome</span>
                        <p class="text-slate-900 font-semibold text-right">{{ $user->nome }}</p>
                    </div>
                    <div class="flex items-center justify-between gap-2 border-b border-slate-50 pb-3">
                        <span class="text-slate-500 font-medium">Email</span>
                        <p class="text-slate-900 font-semibold text-right break-all">{{ $user->email }}</p>
                    </div>
                    <div class="flex items-center justify-between gap-2 border-b border-slate-50 pb-3">
                        <span class="text-slate-500 font-medium">Telefone</span>
                        <p class="text-slate-900 font-semibold text-right">{{ $user->telefone ?: 'Não informado' }}</p>
                    </div>
                    <div class="flex items-center justify-between gap-2 border-b border-slate-50 pb-3">
                        <span class="text-slate-500 font-medium">Localização</span>
                        <p class="text-slate-900 font-semibold text-right">
                            {{ trim(($user->cidade ?? '') . (!empty($user->cidade) && !empty($user->pais) ? ', ' : '') . ($user->pais ?? '')) ?: 'Não informado' }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between gap-2 pt-1">
                        <span class="text-slate-500 font-medium">Cliente desde</span>
                        <p class="text-slate-700 font-medium text-xs bg-slate-100 px-2.5 py-1 rounded-full">
                            {{ optional($user->data_criacao ? \Carbon\Carbon::parse($user->data_criacao) : null)->format('d M Y') ?? '—' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-7 xl:col-span-2">
                <div class="flex items-center justify-between mb-6 gap-4">
                    <h2 class="text-lg font-bold text-slate-950 flex items-center gap-2.5">
                        <i class="fas fa-shopping-bag text-orange-600"></i> Últimos pedidos
                    </h2>
                    @if($pedidos->isNotEmpty())
                        <a href="{{ route('user.pedidos') }}" class="px-4 py-1.5 border border-slate-200 hover:border-slate-300 rounded-lg text-slate-700 hover:text-slate-900 hover:bg-slate-50 text-xs font-semibold transition-all">
                            Ver histórico completo
                        </a>
                    @endif
                </div>

                @if($pedidos->isNotEmpty())
                    <div class="overflow-x-auto rounded-xl border border-slate-100">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50/50 border-b border-slate-100 text-slate-600 uppercase text-[11px] tracking-wider">
                                <tr>
                                    <th class="px-5 py-3.5 font-semibold">Pedido</th>
                                    <th class="px-5 py-3.5 font-semibold">Descrição</th>
                                    <th class="px-5 py-3.5 font-semibold text-right">Valor</th>
                                    <th class="px-5 py-3.5 font-semibold text-center">Estado</th>
                                    <th class="px-5 py-3.5 font-semibold text-right">Data</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-800">
                                @foreach ($pedidos as $pedido)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-5 py-4 font-mono text-xs text-orange-700 bg-orange-50/50">#{{ $pedido->numero_pedido }}</td>
                                        <td class="px-5 py-4 text-slate-700 max-w-xs truncate">{{ $pedido->descricao ?: 'Pedido sem descrição' }}</td>
                                        <td class="px-5 py-4 font-bold text-slate-950 text-right">MZN {{ number_format((float) ($pedido->valor ?? 0), 2, ',', '.') }}</td>
                                        <td class="px-5 py-4 text-center">
                                            <span class="px-3 py-1.5 rounded-full text-xs font-bold inline-block shadow-inner
                                                @if(($pedido->status ?? '') === 'pendente') bg-amber-100 text-amber-800
                                                @elseif(($pedido->status ?? '') === 'processando') bg-blue-100 text-blue-800
                                                @elseif(($pedido->status ?? '') === 'enviado') bg-purple-100 text-purple-800
                                                @elseif(($pedido->status ?? '') === 'entregue') bg-emerald-100 text-emerald-900
                                                @else bg-rose-100 text-rose-800
                                                @endif
                                            ">
                                                {{ ucfirst($pedido->status ?? 'pendente') }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 text-slate-600 text-right text-xs">
                                            {{ optional($pedido->data_criacao ? \Carbon\Carbon::parse($pedido->data_criacao) : null)->format('d/m/Y') ?? '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                        <i class="fas fa-box-open text-slate-300 text-4xl mb-4"></i>
                        <p class="text-slate-600 font-medium">Ainda não há pedidos realizados.</p>
                        <p class="text-xs text-slate-500 mt-1">Os seus pedidos aparecerão aqui assim que forem confirmados.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection