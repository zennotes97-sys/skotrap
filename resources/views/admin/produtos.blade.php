@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen max-w-5xl">
    {{-- Header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Produtos</h1>
            <p class="text-sm text-zinc-500 mt-2">Gerencie estampas, categorias e visualize suas criações com rapidez.</p>
        </div>
        <div class="rounded-3xl border border-zinc-200 bg-white px-5 py-4 shadow-sm">
            <span class="text-sm text-zinc-500">Estampas cadastradas</span>
            <p class="text-3xl font-semibold text-orange-500 mt-1">{{ $estampas->count() }}</p>
        </div>
    </div>

    {{-- Feedback Alerts --}}
    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-lg px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @php
        $categorias = App\Models\Categoria::where('ativo', true)->orderBy('nome')->get();
    @endphp

    <div class="space-y-8">
        @if(isset($estampa))
            {{-- Seção 1: Formulário de Edição --}}
            <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6 gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-zinc-900">Editar estampa</h2>
                        <p class="text-sm text-zinc-500">Atualize os dados da estampa selecionada.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-orange-600">Editar</span>
                </div>

                <form action="{{ route('admin.estampas.update', $estampa->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Nome</label>
                            <input type="text" name="nome" value="{{ old('nome', $estampa->nome) }}" required class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Nome da estampa">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Produto</label>
                            <input type="text" name="produto" value="{{ old('produto', $estampa->produto) }}" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Camiseta, Boné, etc.">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Descrição</label>
                        <textarea name="descricao" rows="3" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Dê mais detalhes sobre a estampa">{{ old('descricao', $estampa->descricao) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Preço</label>
                            <input type="number" step="0.01" name="preco" value="{{ old('preco', $estampa->preco) }}" required class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="0,00">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Técnica</label>
                            <input type="text" name="tecnica" value="{{ old('tecnica', $estampa->tecnica) }}" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Serigrafia, Sublimação...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Categoria</label>
                            <select name="categoria_id" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                                <option value="">Selecione a categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @selected(old('categoria_id', $estampa->categoria_id) == $categoria->id)>{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2">
                        <div class="w-full sm:max-w-xs">
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Nova imagem</label>
                            <input type="file" name="imagem" accept="image/*" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm text-zinc-900 focus:outline-none">
                            @if($estampa->imagem)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $estampa->imagem) }}" alt="{{ $estampa->nome }}" class="h-20 w-20 rounded-xl object-cover border border-zinc-200">
                                </div>
                            @endif
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.produtos') }}" class="inline-flex items-center justify-center rounded-2xl border border-zinc-300 px-6 py-3 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-50">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                                Atualizar estampa
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        @else
            {{-- Seção 1: Formulário de Cadastro --}}
            <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6 gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-zinc-900">Adicionar nova estampa</h2>
                        <p class="text-sm text-zinc-500">Preencha as informações básicas e faça upload da imagem.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-orange-600">Novo</span>
                </div>

                <form action="{{ route('admin.estampas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Nome</label>
                            <input type="text" name="nome" required class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Nome da estampa">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Produto</label>
                            <input type="text" name="produto" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Camiseta, Boné, etc.">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Descrição</label>
                        <textarea name="descricao" rows="3" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Dê mais detalhes sobre a estampa"></textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Preço</label>
                            <input type="number" step="0.01" name="preco" value="0.00" required class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="0,00">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Técnica</label>
                            <input type="text" name="tecnica" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Serigrafia, Sublimação...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Categoria</label>
                            <select name="categoria_id" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                                <option value="">Selecione a categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2">
                        <div class="w-full sm:max-w-xs">
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Imagem</label>
                            <input type="file" name="imagem" accept="image/*" class="w-full rounded-2xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm text-zinc-900 focus:outline-none">
                        </div>
                        <button type="submit" class="sm:mt-7 inline-flex items-center justify-center rounded-2xl bg-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                            Salvar estampa
                        </button>
                    </div>
                </form>
            </section>
        @endif

        {{-- Seção 2: Lista de Estampas (Agora por baixo) --}}
        <section class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-zinc-900">Estampas cadastradas</h2>
                    <p class="text-sm text-zinc-500">Veja suas estampas ativas, edite ou remova do catálogo.</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-zinc-600">Total {{ $estampas->count() }}</span>
            </div>

            <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
                @forelse($estampas as $estampa)
                    <article class="group relative rounded-3xl border border-zinc-200 p-4 transition hover:border-orange-300 hover:shadow-md flex items-start gap-4">
                        
                        {{-- Imagem --}}
                        @if($estampa->imagem)
                            <img src="{{ asset('storage/' . $estampa->imagem) }}" alt="{{ $estampa->nome }}" class="h-24 w-24 rounded-2xl object-cover flex-shrink-0">
                        @else
                            <div class="flex h-24 w-24 flex-shrink-0 items-center justify-center rounded-2xl bg-zinc-100 text-sm text-zinc-500">
                                Sem imagem
                            </div>
                        @endif

                        {{-- Conteúdo --}}
                        <div class="flex-1 pr-8">
                            <h3 class="text-base font-semibold text-zinc-900 pr-4">{{ $estampa->nome }}</h3>
                            <p class="mt-1 text-xs leading-relaxed text-zinc-600 line-clamp-2">{{ $estampa->descricao ?? 'Sem descrição informada.' }}</p>
                            
                            <div class="mt-3 flex flex-wrap gap-2 text-[11px] text-zinc-500">
                                <span class="rounded-full bg-zinc-50 border border-zinc-200 px-2.5 py-0.5 font-medium text-zinc-700">
                                    R$ {{ number_format($estampa->preco, 2, ',', '.') }}
                                </span>
                                <span class="rounded-full border border-zinc-100 px-2.5 py-0.5 bg-zinc-50">
                                    {{ $estampa->produto ?: 'Sem produto' }}
                                </span>
                                <span class="rounded-full border border-zinc-100 px-2.5 py-0.5 bg-zinc-50">
                                    {{ $estampa->tecnica ?: 'Sem técnica' }}
                                </span>
                            </div>
                        </div>

                       {{-- Botão de Opções (Alternativa 100% Nativa com HTML/CSS) --}}
                    <details class="absolute top-4 right-4 list-none group/menu">
                        <summary class="list-none cursor-pointer text-zinc-400 hover:text-zinc-600 p-1 rounded-full hover:bg-zinc-100 transition focus:outline-none flex items-center justify-center">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5?" />
                            </svg>
                        </summary>

                        {{-- Menu Dropdown --}}
                        <div class="absolute right-0 mt-1 w-36 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-20 py-1 divide-y divide-zinc-100 origin-top-right">
                            <div class="py-1">
                                <a href="{{ route('admin.estampas.edit', $estampa->id) }}" class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900">
                                    Editar
                                </a>
                            </div>
                            <div class="py-1">
                                <form action="{{ route('admin.estampas.destroy', $estampa->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta estampa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        Deletar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </details>

                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-dashed border-zinc-300 bg-zinc-50 p-8 text-center text-zinc-500">
                        Nenhuma estampa cadastrada ainda.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection