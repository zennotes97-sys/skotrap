@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4 max-w-5xl">
    
    @if (isset($conversa_ativa))
        <div class="bg-white rounded-2xl shadow-sm border border-zinc-200/80 overflow-hidden flex flex-col h-[600px]">
            
            <div class="p-4 bg-zinc-950 text-white flex justify-between items-center border-b border-zinc-800 shrink-0">
                <div class="flex items-center gap-3">
                    <a href="{{ route('user.mensagens') }}" class="text-zinc-400 hover:text-orange-500 transition-colors p-2 rounded-lg hover:bg-zinc-900">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                    <div>
                        <h3 class="font-bold text-base tracking-wide">{{ $conversa_ativa->assunto }}</h3>
                        <p class="text-xs text-orange-400 capitalize font-medium">Categoria: {{ $conversa_ativa->tipo }}</p>
                    </div>
                </div>
                <div>
                    @php
                        $statusClasses = match($conversa_ativa->status) {
                            'nao_lido'    => 'bg-blue-500/10 text-blue-400 border-blue-500/30',
                            'respondido'  => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                            'fechado'     => 'bg-rose-500/10 text-rose-400 border-rose-500/30',
                            default       => 'bg-zinc-500/10 text-zinc-400 border-zinc-500/30',
                        };
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusClasses }}">
                        {{ ucfirst(str_replace('_', ' ', $conversa_ativa->status)) }}
                    </span>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6 bg-zinc-50/50 space-y-4 custom-scrollbar">
                
                @foreach ($respostas as $resp)
                    @if ($resp->remetente_id === Auth::id())
                        <div class="flex justify-end pl-12">
                            <div class="bg-zinc-900 text-zinc-100 p-4 rounded-2xl rounded-tr-none shadow-sm border border-zinc-800">
                                <p class="text-sm leading-relaxed whitespace-pre-line">{{ $resp->conteudo }}</p>
                                <span class="block text-[10px] text-zinc-500 text-right mt-1.5 font-medium">
                                    {{ \Carbon\Carbon::parse($resp->created_at)->format('H:i - d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start pr-12">
                            <div class="bg-white text-zinc-800 p-4 rounded-2xl rounded-tl-none shadow-sm border border-zinc-200/60 border-l-4 border-l-orange-500">
                                <span class="block text-xs font-bold text-orange-600 mb-1">
                                    Suporte SKO-TRAP ({{ $resp->admin_nome ?? 'Admin' }})
                                </span>
                                <p class="text-sm leading-relaxed whitespace-pre-line">{{ $resp->conteudo }}</p>
                                <span class="block text-[10px] text-zinc-400 mt-1.5 font-medium">
                                    {{ \Carbon\Carbon::parse($resp->created_at)->format('H:i - d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>

            @if ($conversa_ativa->status !== 'fechado')
                <div class="p-4 bg-white border-t border-zinc-200 shrink-0">
                    <form action="{{ route('user.mensagens.enviar', $conversa_ativa->id) }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="text" name="conteudo" placeholder="Digite sua resposta aqui..." autocomplete="off" required
                               class="flex-1 bg-zinc-50 border border-zinc-200 rounded-xl px-4 py-3 text-sm text-zinc-800 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-3 rounded-xl shadow-md shadow-orange-500/10 transition-all flex items-center justify-center shrink-0">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="p-4 bg-zinc-100 text-center text-zinc-500 text-xs font-semibold shrink-0">
                    <i class="fas fa-lock mr-1"></i> Este tópico foi encerrado pelo administrador e não aceita novas respostas.
                </div>
            @endif

        </div>
    @else
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900">Minhas Mensagens</h2>
            <a href="/user/contato" class="bg-zinc-900 hover:bg-zinc-800 text-white text-sm font-bold px-4 py-2.5 rounded-xl border border-zinc-800 transition-all shadow-sm">
                Novo Contato <i class="fas fa-plus ml-1.5 text-orange-500"></i>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-zinc-200/80 overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-zinc-100 border-b border-zinc-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Assunto</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-zinc-600 tracking-wider">Última Atualização</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-zinc-600 tracking-wider">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 text-sm">
                    @forelse ($mensagens as $msg)
                        <tr class="hover:bg-zinc-50/80 transition-colors duration-150 text-zinc-800">
                            <td class="px-6 py-4">
                                <span class="{{ $msg->status === 'nao_lido' ? 'font-bold text-zinc-950' : 'text-zinc-700' }}">
                                    {{ $msg->assunto }}
                                </span>
                            </td>
                            <td class="px-6 py-4 capitalize text-zinc-600 font-medium">{{ $msg->tipo }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $badge = match($msg->status) {
                                        'nao_lido'    => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'respondido'  => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                        'fechado'     => 'bg-rose-100 text-rose-800 border-rose-200',
                                        default       => 'bg-zinc-100 text-zinc-800 border-zinc-200',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $msg->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-zinc-500">
                                {{ \Carbon\Carbon::parse($msg->updated_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="?id={{ $msg->id }}" class="inline-flex items-center gap-1.5 text-xs font-bold bg-zinc-100 hover:bg-orange-500 text-zinc-700 hover:text-white px-3 py-1.5 rounded-lg transition-all">
                                    Abrir Chat <i class="fas fa-comments text-[11px]"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="far fa-envelope text-3xl text-zinc-300"></i>
                                    <p class="text-sm font-medium">Nenhum histórico de suporte aberto.</p>
                                </div>
                            </td>
                        </tr>
                    @empty
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $mensagens->links() }}
        </div>
    @endif
</div>
@endsection