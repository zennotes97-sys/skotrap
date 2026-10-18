{{-- Define o layout base --}}
@extends('layouts.app')

{{-- Define o título da página --}}
@section('title', 'Confirmar Pedido')

{{-- Define o conteúdo da página --}}
@section('content')
<div class="max-w-4xl mx-auto bg-zinc-900 rounded-2xl shadow-2xl p-6 md:p-10 border border-zinc-800">

    {{-- Cabeçalho --}}
    <div class="border-b border-zinc-800 pb-6 mb-8">
        <h1 class="text-3xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-shopping-cart text-orange-500"></i>
            Confirmar Pedido
        </h1>
        <p class="text-zinc-400 mt-2">Revise os detalhes do seu pedido e confirme para finalizar via WhatsApp.</p>
    </div>

    {{-- Detalhes do Produto --}}
    <div class="grid md:grid-cols-3 gap-8 items-start">
        
        {{-- Imagem do Produto --}}
        <div class="md:col-span-1">
            <div class="aspect-square bg-zinc-800 rounded-2xl overflow-hidden border border-zinc-700">
                <img src="{{ $estampa->imagem ? asset('storage/' . $estampa->imagem) : asset('imagens/Animes.png') }}" 
                     alt="{{ $estampa->nome }}" 
                     class="w-full h-full object-cover">
            </div>
        </div>

        {{-- Informações e Ações --}}
        <div class="md:col-span-2 space-y-6">
            <div>
                <h2 id="product-name" class="text-2xl font-bold text-white">{{ $estampa->nome }}</h2>
                <p class="text-zinc-400 mt-1">{{ $estampa->descricao ?: 'Estampa exclusiva da coleção SKO-TRAP.' }}</p>
            </div>

            {{-- Preço Unitário --}}
            <div class="bg-zinc-800/50 border border-zinc-700/80 rounded-xl p-4">
                <p class="text-sm text-zinc-400">Preço Unitário</p>
                <p id="unit-price" data-price="{{ $estampa->preco }}" class="text-xl font-semibold text-orange-400">
                    MZN {{ number_format($estampa->preco, 2, ',', '.') }}
                </p>
            </div>

            {{-- Seletor de Quantidade --}}
            <div class="space-y-3">
                <label class="font-semibold text-white">Quantidade</label>
                <div class="flex items-center gap-4">
                    <button id="decrease-qty" class="w-10 h-10 bg-zinc-800 rounded-full text-zinc-300 hover:bg-zinc-700 transition-colors">-</button>
                    <input id="quantity" type="number" value="1" min="1" class="w-20 text-center bg-transparent text-white font-bold text-lg focus:outline-none">
                    <button id="increase-qty" class="w-10 h-10 bg-zinc-800 rounded-full text-zinc-300 hover:bg-zinc-700 transition-colors">+</button>
                </div>
            </div>

            {{-- Total e Botão de Confirmação --}}
            <div class="border-t border-zinc-800 pt-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-zinc-300">Total do Pedido:</span>
                    <span id="total-price" class="text-3xl font-bold text-orange-400">
                        MZN {{ number_format($estampa->preco, 2, ',', '.') }}
                    </span>
                </div>

                <button id="confirm-whatsapp" class="w-full bg-green-500 text-white font-bold py-4 rounded-xl flex items-center justify-center gap-3 hover:bg-green-600 transition-all shadow-lg shadow-green-500/20">
                    <i class="fab fa-whatsapp text-xl"></i>
                    Confirmar Pedido no WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.getElementById('decrease-qty');
    const increaseBtn = document.getElementById('increase-qty');
    const unitPriceEl = document.getElementById('unit-price');
    const totalPriceEl = document.getElementById('total-price');
    const confirmBtn = document.getElementById('confirm-whatsapp');
    const productName = document.getElementById('product-name').textContent;

    const unitPrice = parseFloat(unitPriceEl.dataset.price);

    function updateTotalPrice() {
        let quantity = parseInt(quantityInput.value);
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            quantityInput.value = 1;
        }
        const totalPrice = unitPrice * quantity;
        totalPriceEl.textContent = 'MZN ' + totalPrice.toLocaleString('pt-PT', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    increaseBtn.addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateTotalPrice();
    });

    decreaseBtn.addEventListener('click', () => {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
            updateTotalPrice();
        }
    });

    quantityInput.addEventListener('input', updateTotalPrice);

    confirmBtn.addEventListener('click', () => {
        const quantity = quantityInput.value;
        const total = totalPriceEl.textContent;
        const user = "{{ auth()->user()->nome }}";
        
        const message = `Olá! 👋\nMeu nome é ${user} e gostaria de confirmar meu pedido:\n\n*Produto:* ${productName}\n*Quantidade:* ${quantity}\n*Total:* ${total}\n\nAgradeço e aguardo as próximas instruções!`;
        
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    });
});
</script>
@endsection
