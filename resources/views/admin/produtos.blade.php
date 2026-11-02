@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Catálogo</p>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Produtos</h1>
                <p class="mt-2 text-sm text-slate-600">Gerencie estampas, categorias e visualize as suas criações com rapidez.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="rounded-3xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
                    <span class="text-sm text-slate-500">Estampas cadastradas</span>
                    <p class="mt-1 text-3xl font-extrabold text-orange-600">
                        {{ $totalEstampas ?? ($estampas instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $estampas->total() : $estampas->count()) }}
                    </p>
                </div>
                <button type="button" onclick="document.getElementById('add-product-modal').classList.remove('hidden')" class="inline-flex items-center justify-center rounded-2xl bg-orange-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                    <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Adicionar Produto
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @php
            $categorias = App\Models\Categoria::where('ativo', true)->orderBy('nome')->get();
        @endphp

        <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <form method="GET" action="{{ route('admin.produtos') }}" class="grid gap-3 md:grid-cols-[2fr_220px_180px_140px_auto]">
                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Pesquisa</span>
                    <input type="text" id="live-product-search" name="search" value="{{ request('search') }}" placeholder="Nome, descrição ou produto" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                </label>

                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Categoria</span>
                    <select id="live-product-category" name="categoria_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        <option value="">Todas</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Status</span>
                    <select id="live-product-status" name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        <option value="">Todos</option>
                        <option value="ativo" {{ request('status') === 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ request('status') === 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </label>

                <label class="block">
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Items</span>
                    <select id="live-product-per-page" name="per_page" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        <option value="8" {{ request('per_page', 8) == 8 ? 'selected' : '' }}>8</option>
                        <option value="12" {{ request('per_page', 8) == 12 ? 'selected' : '' }}>12</option>
                        <option value="24" {{ request('per_page', 8) == 24 ? 'selected' : '' }}>24</option>
                        <option value="48" {{ request('per_page', 8) == 48 ? 'selected' : '' }}>48</option>
                    </select>
                </label>

                <div class="flex items-end gap-2">
                    <button type="submit" class="inline-flex h-[42px] items-center justify-center rounded-2xl bg-orange-600 px-4 text-sm font-semibold text-white transition hover:bg-orange-500">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.produtos') }}" class="inline-flex h-[42px] items-center justify-center rounded-2xl border border-slate-200 bg-white px-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Limpar
                    </a>
                </div>
            </form>
        </div>

        <div class="space-y-8">
            @if(isset($estampa))
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Editar estampa</h2>
                            <p class="mt-1 text-sm text-slate-500">Atualize os dados da estampa selecionada.</p>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-orange-700">Editar</span>
                    </div>

                    <form action="{{ route('admin.estampas.update', $estampa->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Nome</label>
                                <input type="text" name="nome" value="{{ old('nome', $estampa->nome) }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Nome da estampa">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Produto</label>
                                <input type="text" name="produto" value="{{ old('produto', $estampa->produto) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Camiseta, Boné, etc.">
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Descrição</label>
                            <textarea name="descricao" rows="3" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Dê mais detalhes sobre a estampa">{{ old('descricao', $estampa->descricao) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Preço</label>
                                <input type="number" step="0.01" name="preco" value="{{ old('preco', $estampa->preco) }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="0,00">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Técnica</label>
                                <input type="text" name="tecnica" value="{{ old('tecnica', $estampa->tecnica) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Serigrafia, Sublimação...">
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Categoria</label>
                                <select name="categoria_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                                    <option value="">Selecione a categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @selected(old('categoria_id', $estampa->categoria_id) == $categoria->id)>{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col justify-between gap-4 pt-2 sm:flex-row sm:items-center">
                            <div class="w-full sm:max-w-xs">
                                <label class="mb-2 block text-sm font-medium text-slate-700">Nova imagem</label>
                                <input type="file" name="imagem" accept="image/*" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none">
                                @if($estampa->imagem)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $estampa->imagem) }}" alt="{{ $estampa->nome }}" class="h-20 w-20 rounded-xl border border-slate-200 object-cover">
                                    </div>
                                @endif
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('admin.produtos') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                    Cancelar
                                </a>
                                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                                    Atualizar estampa
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            @endif

            <div id="add-product-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex min-h-full items-center justify-center bg-slate-900/60 px-4 py-10 backdrop-blur-sm">
                    <div class="w-full max-w-3xl rounded-[28px] border border-slate-200 bg-white p-6 shadow-2xl">
                        <div class="mb-6 flex items-center justify-between gap-4">
                            <div>
                                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.22em] text-orange-600">Novo produto</p>
                                <h2 class="text-2xl font-black tracking-tight text-slate-900">Adicionar estampa</h2>
                            </div>
                            <button type="button" onclick="document.getElementById('add-product-modal').classList.add('hidden')" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('admin.estampas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Nome</label>
                                    <input type="text" name="nome" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Nome da estampa">
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Produto</label>
                                    <input type="text" name="produto" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Camiseta, Boné, etc.">
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Descrição</label>
                                <textarea name="descricao" rows="3" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Dê mais detalhes sobre a estampa"></textarea>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Preço</label>
                                    <input type="number" step="0.01" name="preco" value="0.00" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="0,00">
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Técnica</label>
                                    <input type="text" name="tecnica" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100" placeholder="Serigrafia, Sublimação...">
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Categoria</label>
                                    <select name="categoria_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-100">
                                        <option value="">Selecione a categoria</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-col justify-between gap-4 pt-2 sm:flex-row sm:items-center">
                                <div class="w-full sm:max-w-xs">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Imagem</label>
                                    <input type="file" name="imagem" accept="image/*" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:outline-none">
                                </div>
                                <div class="flex gap-3">
                                    <button type="button" onclick="document.getElementById('add-product-modal').classList.add('hidden')" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-500">
                                        Salvar estampa
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Estampas cadastradas</h2>
                        <p class="mt-1 text-sm text-slate-500">Veja suas estampas ativas, edite ou remova do catálogo.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-700">Total {{ $estampas->count() }}</span>
                </div>

                @if(method_exists($estampas, 'firstItem') && method_exists($estampas, 'lastItem') && method_exists($estampas, 'total'))
                    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
                        <span>Mostrando {{ $estampas->firstItem() ?? 0 }}-{{ $estampas->lastItem() ?? 0 }} de {{ $estampas->total() }}</span>
                        <span>{{ $estampas->count() }} itens nesta página</span>
                    </div>
                @endif

                <div class="grid gap-4 md:grid-cols-2">
                    @forelse($estampas as $estampa)
                        <article
                            class="group relative flex items-start gap-4 rounded-3xl border border-slate-200 p-4 transition hover:border-orange-300 hover:shadow-md"
                            data-product-card
                            data-search="{{ strtolower(($estampa->nome ?? '') . ' ' . ($estampa->descricao ?? '') . ' ' . ($estampa->produto ?? '') . ' ' . ($estampa->tecnica ?? '') . ' ' . ($estampa->categoria->nome ?? '')) }}"
                            data-category="{{ $estampa->categoria_id ?? '' }}"
                            data-status="{{ $estampa->ativo ? 'ativo' : 'inativo' }}"
                        >
                            @if($estampa->imagem)
                                <img src="{{ asset('storage/' . $estampa->imagem) }}" alt="{{ $estampa->nome }}" class="h-24 w-24 flex-shrink-0 rounded-2xl object-cover">
                            @else
                                <div class="flex h-24 w-24 flex-shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-sm text-slate-500">
                                    Sem imagem
                                </div>
                            @endif

                            <div class="flex-1 pr-8">
                                <h3 class="pr-4 text-base font-semibold text-slate-900">{{ $estampa->nome }}</h3>
                                <p class="mt-1 text-xs leading-relaxed text-slate-600">{{ $estampa->descricao ?? 'Sem descrição informada.' }}</p>

                                <div class="mt-3 flex flex-wrap gap-2 text-[11px] text-slate-500">
                                    <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 font-medium text-slate-700">
                                        MZN {{ number_format($estampa->preco, 2, ',', '.') }}
                                    </span>
                                    <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5">
                                        {{ $estampa->produto ?: 'Sem produto' }}
                                    </span>
                                    <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5">
                                        {{ $estampa->tecnica ?: 'Sem técnica' }}
                                    </span>
                                </div>
                            </div>

                            <details class="absolute right-4 top-4 list-none group/menu">
                                <summary class="flex cursor-pointer list-none items-center justify-center rounded-full p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </summary>

                                <div class="absolute right-0 z-20 mt-1 w-36 origin-top-right divide-y divide-slate-100 rounded-xl bg-white py-1 shadow-lg ring-1 ring-slate-200">
                                    <div class="py-1">
                                        <a href="{{ route('admin.estampas.edit', $estampa->id) }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900">Editar</a>
                                    </div>
                                    <div class="py-1">
                                        <form action="{{ route('admin.estampas.destroy', $estampa->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta estampa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex w-full items-center px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50">Deletar</button>
                                        </form>
                                    </div>
                                </div>
                            </details>
                        </article>
                    @empty
                        <div id="products-empty-state" class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-500">
                            Nenhuma estampa cadastrada ainda.
                        </div>
                    @endforelse
                </div>
            </section>

            @if(method_exists($estampas, 'hasPages') && $estampas->hasPages())
                <div class="mt-6">
                    {{ $estampas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('live-product-search');
        const categorySelect = document.getElementById('live-product-category');
        const statusSelect = document.getElementById('live-product-status');
        const cards = Array.from(document.querySelectorAll('[data-product-card]'));
        const emptyState = document.getElementById('products-empty-state');

        function applyProductFilter() {
            const query = (searchInput ? searchInput.value : '').trim().toLowerCase();
            const category = categorySelect ? categorySelect.value : '';
            const status = statusSelect ? statusSelect.value : '';
            let visible = 0;

            cards.forEach((card) => {
                const matchesSearch = !query || (card.dataset.search || '').includes(query);
                const matchesCategory = !category || (card.dataset.category || '') === category;
                const matchesStatus = !status || (card.dataset.status || '') === status;

                const shouldShow = matchesSearch && matchesCategory && matchesStatus;
                card.classList.toggle('hidden', !shouldShow);
                if (shouldShow) visible++;
            });

            if (emptyState) {
                emptyState.classList.toggle('hidden', visible > 0 || (query === '' && category === '' && status === ''));
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyProductFilter);
        }
        if (categorySelect) {
            categorySelect.addEventListener('change', applyProductFilter);
        }
        if (statusSelect) {
            statusSelect.addEventListener('change', applyProductFilter);
        }
    });
</script>
@endsection