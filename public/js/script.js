// ====================== SCRIPT.JS - SKO-TRAP ======================

document.addEventListener('DOMContentLoaded', () => {

  // ==================== NAVBAR SCROLL ====================
  const navbar = document.getElementById('navbar');
  const navbarContainer = document.getElementById('navbar-container');

  function handleNavbar() {
    if (!navbar || !navbarContainer) return;

    if (window.scrollY > 50) {
      navbar.classList.add('navbar-scrolled', 'bg-black/90', 'backdrop-blur-lg', 'border-zinc-800');
      navbarContainer.classList.remove('py-6');
      navbarContainer.classList.add('py-3.5');
    } else {
      navbar.classList.remove('navbar-scrolled', 'bg-black/90', 'backdrop-blur-lg', 'border-zinc-800');
      navbarContainer.classList.remove('py-3.5');
      navbarContainer.classList.add('py-6');
    }
  }

  window.addEventListener('scroll', handleNavbar);

  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      const icon = mobileMenuBtn.querySelector('i');
      if (icon) {
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
      }
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', event => {
        const targetId = link.getAttribute('href');

        mobileMenu.classList.add('hidden');
        const icon = mobileMenuBtn.querySelector('i');
        if (icon) {
          icon.classList.add('fa-bars');
          icon.classList.remove('fa-xmark');
        }

        if (!targetId || !targetId.startsWith('#')) return;

        const target = document.querySelector(targetId);
        if (!target) return;

        event.preventDefault();
        const navbarHeight = navbar ? navbar.offsetHeight : 0;
        const targetPosition = target.getBoundingClientRect().top + window.scrollY - navbarHeight;

        window.history.replaceState(null, '', targetId);
        window.scrollTo({ top: Math.max(0, targetPosition), behavior: 'smooth' });
      });
    });
  }

  // ==================== PESQUISA EM TEMPO REAL ====================
  const searchInput = document.getElementById('searchInput');
  const searchButton = document.getElementById('searchButton');
  const mobileSearchInput = document.getElementById('mobileSearchInput');
  const mobileSearchButton = document.getElementById('mobileSearchButton');
  const mobileSearchBtn = document.getElementById('mobile-search-btn');
  const mobileSearchBar = document.getElementById('mobile-search-bar');
  const mobileSearchBack = document.getElementById('mobile-search-back');
  const mobileNavbarMain = document.getElementById('mobile-navbar-main');
  const estampaCards = document.querySelectorAll('[data-estampa-card]');
  const emptySearchState = document.getElementById('emptySearchState');

  if (searchInput || mobileSearchInput) {
    const applySearch = (sourceInput) => {
      const term = sourceInput.value.trim().toLowerCase();
      let visibleCount = 0;

      [searchInput, mobileSearchInput].forEach(input => {
        if (input && input !== sourceInput) input.value = sourceInput.value;
      });

      document.body.classList.toggle('searching', !!term);

      estampaCards.forEach(card => {
        const haystack = (card.dataset.search || '').toLowerCase();
        const matches = !term || haystack.includes(term);
        card.classList.toggle('hidden', !matches);
        if (matches) visibleCount++;
      });

      if (emptySearchState) {
        emptySearchState.classList.toggle('hidden', visibleCount > 0 || !term);
      }
    };

    [searchInput, mobileSearchInput].forEach(input => {
      if (!input) return;

      input.addEventListener('input', () => applySearch(input));
      input.addEventListener('focus', () => {
        if (input.value.trim()) {
          document.body.classList.add('searching');
        }
      });
      input.addEventListener('blur', () => {
        if (!input.value.trim()) {
          document.body.classList.remove('searching');
        }
      });
    });

    [searchButton, mobileSearchButton].forEach(button => {
      if (button) {
        button.addEventListener('click', () => {
          const input = button === mobileSearchButton ? mobileSearchInput : searchInput;
          if (input) {
            applySearch(input);
            input.focus();
          }
        });
      }
    });

    if (mobileSearchBtn) {
      mobileSearchBtn.addEventListener('click', () => {
        if (mobileNavbarMain) mobileNavbarMain.classList.add('hidden');
        if (mobileMenuBtn) mobileMenuBtn.classList.add('hidden');
        if (mobileSearchBtn) mobileSearchBtn.classList.add('hidden');
        if (mobileSearchBar) {
          mobileSearchBar.classList.remove('hidden');
          mobileSearchBar.classList.add('flex');
        }
        if (mobileSearchInput) mobileSearchInput.focus();
      });
    }

    if (mobileSearchBack) {
      mobileSearchBack.addEventListener('click', () => {
        if (mobileSearchInput) {
          mobileSearchInput.value = '';
          applySearch(mobileSearchInput);
        } else if (searchInput) {
          searchInput.value = '';
          applySearch(searchInput);
        }

        if (mobileSearchBar) {
          mobileSearchBar.classList.add('hidden');
          mobileSearchBar.classList.remove('flex');
        }
        if (mobileNavbarMain) mobileNavbarMain.classList.remove('hidden');
        if (mobileMenuBtn) mobileMenuBtn.classList.remove('hidden');
        if (mobileSearchBtn) mobileSearchBtn.classList.remove('hidden');
      });
    }
  }

  // ==================== CAROUSEL ====================

  // ==================== ROTATING TEXT ====================
  const frases = [
    "Qualidade que impressiona",
    "Estampas que contam histórias",
    "Cores vibrantes que duram",
    "Sua marca em outro nível",
    "Perfeição em cada detalhe"
  ];

  let index = 0;
  const textElement = document.getElementById('rotating-text');

  if (textElement) {
    function trocarFrase() {
      textElement.style.opacity = 0;
      setTimeout(() => {
        index = (index + 1) % frases.length;
        textElement.textContent = frases[index];
        textElement.style.opacity = 1;
      }, 700);
    }

    setInterval(trocarFrase, 3800);
  }



  // ==================== ANIMAÇÕES COM Carroucel (Reveal) ====================
  const carousel = document.getElementById('carousel');

  if (carousel) {
    const firstCard = carousel.querySelector('.snap-start');
    if (firstCard) {
      const cardWidth = firstCard.offsetWidth + 24; // largura + gap
      let autoPlayIndex = 0;

      function nextSlide() {
        autoPlayIndex++;
        carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
        if (autoPlayIndex >= carousel.querySelectorAll('.snap-start').length) {
          autoPlayIndex = 0;
          carousel.scrollTo({ left: 0, behavior: 'smooth' });
        }
      }

      function prevSlide() {
        autoPlayIndex--;
        if (autoPlayIndex < 0) autoPlayIndex = 0;
        carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
      }

      // Auto-play: troca a cada 5 segundos
      setInterval(nextSlide, 5000);
    }
  }


  // ==================== ANIMAÇÕES COM SCROLL (Reveal) ====================
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px"
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
        observer.unobserve(entry.target); // anima só uma vez
      }
    });
  }, observerOptions);

  // Selecionar elementos para animar
  const animateElements = document.querySelectorAll(`
    .service-card, 
    #estampas .md\\:col-span-5, 
    .estampa-card, 
    section[id="servicos-estamparia"] > div > div, 
    #sobre .md\\:col-span-6, 
    #contacto .md\\:col-span-5, 
    #contacto .md\\:col-span-7
  `);

  animateElements.forEach(el => {
    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700');
    observer.observe(el);
  });

  // Adicionar classe CSS para animação
  const style = document.createElement('style');
  style.innerHTML = `
    .animate-in {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }
    
    /* Efeito extra nos cards de serviço */
    .group:hover .absolute\\.inset-0 {
      opacity: 1;
    }
  `;
  document.head.appendChild(style);

  // ==================== CONTADOR ANIMADO (se quiser usar no futuro) ====================
  function animateCounter(el, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
      start += increment;
      if (start >= target) {
        el.textContent = target + (el.dataset.suffix || '');
        clearInterval(timer);
      } else {
        el.textContent = Math.floor(start) + (el.dataset.suffix || '');
      }
    }, 16);
  }

  // Exemplo de uso futuro:
  // animateCounter(document.querySelector('.counter'), 999);

  // ==================== BARRA DE PROGRESSO ====================
  const progressBar = document.getElementById('progressBar');
  
  if (progressBar) {
    let progressInterval;
    let progressValue = 0;

    // Iniciar barra quando clica em links
    document.addEventListener('click', (e) => {
      const target = e.target.closest('a');
      
      if (target && target.href && !target.href.includes('#') && !target.target) {
        // Verificar se é um link externo ou da mesma página
        if (target.hostname === window.location.hostname) {
          startProgress();
        }
      }
    });

    // Também monitorar navegação com Enter em formulários
    document.addEventListener('submit', () => {
      startProgress();
    });

    function startProgress() {
      progressValue = 10;
      progressBar.style.width = progressValue + '%';
      progressBar.style.display = 'block';

      if (progressInterval) clearInterval(progressInterval);

      progressInterval = setInterval(() => {
        progressValue += Math.random() * 30;
        
        if (progressValue > 95) progressValue = 95;
        
        progressBar.style.width = progressValue + '%';
      }, 300);
    }

    function finishProgress() {
      progressValue = 100;
      progressBar.style.width = progressValue + '%';
      
      if (progressInterval) clearInterval(progressInterval);
      
      setTimeout(() => {
        progressBar.style.opacity = '0';
        progressBar.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
          progressBar.style.display = 'none';
          progressBar.style.opacity = '1';
          progressBar.style.transition = 'width 0.3s ease';
        }, 500);
      }, 500);
    }

    // Finalizar quando a página carrega
    window.addEventListener('beforeunload', finishProgress);
    window.addEventListener('load', finishProgress);
  }

  // ==================== MODAL DE IMAGEM ==================== 
  const imageModal = document.getElementById('imageModal');
  const estampaModal = document.getElementById('estampaModal');
  const expandedImageModal = document.getElementById('expandedImageModal');
  const expandedModalImage = document.getElementById('expandedModalImage');
  const commentPanel = document.getElementById('commentPanel');
  const commentToggleButton = document.getElementById('toggleCommentButton');
  const commentsList = document.getElementById('commentsList');
  const commentInput = document.getElementById('commentInput');
  const makeOrderButton = document.getElementById('makeOrderButton');
  const cartMessage = document.getElementById('cartMessage');
  
  // Armazenar dados do modal
  let modalData = {};
  let likeCount = 0;
  let isLiked = false;
  let comments = [];

  window.openImageModal = function(element) {
    // Obter dados do elemento
    const img = element.querySelector('img');
    const title = element.dataset.title;
    const description = element.dataset.description;
    const technique = element.dataset.technique;
    const product = element.dataset.product;
    const price = element.dataset.price || 'MZN 0,00';

    // Preencher modal
    document.getElementById('modalImage').src = img.src;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalTechnique').textContent = getTechniqueDescription(technique);
    document.getElementById('modalTechniqueBadge').textContent = technique;
    document.getElementById('modalProduct').textContent = product;
    if (document.getElementById('modalPrice')) {
      document.getElementById('modalPrice').textContent = price;
    }

    // Resetar estados
    likeCount = 0;
    isLiked = false;
    comments = [];
    if (commentInput) commentInput.value = '';
    if (commentPanel) commentPanel.classList.add('hidden');
    if (commentToggleButton) {
      commentToggleButton.classList.remove('bg-orange-500', 'text-black');
      commentToggleButton.classList.add('bg-transparent', 'text-orange-400');
    }
    updateLikeButton();
    renderComments();

    // Mostrar modal
    imageModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // Armazenar dados
    const id = element.dataset.id;
    modalData = { id, title, description, technique, product, price, image: img.src };
    if (makeOrderButton) {
      makeOrderButton.style.display = id ? 'inline-flex' : 'none';
    }
    if (cartMessage) {
      cartMessage.classList.add('hidden');
    }
  };

  window.openImageModalFromImg = function(element) {
    // Obter dados do container pai (que tem os data-attributes)
    const container = element.classList.contains('relative') ? element : element.closest('.relative');
    const img = container.querySelector('img');
    const title = container.dataset.title;
    const description = container.dataset.description;
    const technique = container.dataset.technique;
    const product = container.dataset.product;
    const price = container.dataset.price || 'MZN 0,00';
    const id = container.dataset.id;

    // Preencher modal
    document.getElementById('modalImage').src = img.src;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalTechnique').textContent = getTechniqueDescription(technique);
    document.getElementById('modalTechniqueBadge').textContent = technique;
    document.getElementById('modalProduct').textContent = product;
    if (document.getElementById('modalPrice')) {
      document.getElementById('modalPrice').textContent = price;
    }

    // Resetar estados
    likeCount = 0;
    isLiked = false;
    comments = [];
    if (commentInput) commentInput.value = '';
    if (commentPanel) commentPanel.classList.add('hidden');
    if (commentToggleButton) {
      commentToggleButton.classList.remove('bg-orange-500', 'text-black');
      commentToggleButton.classList.add('bg-transparent', 'text-orange-400');
    }
    updateLikeButton();
    renderComments();

    // Mostrar modal
    imageModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // Armazenar dados
    modalData = { id, title, description, technique, product, price, image: img.src };
    if (makeOrderButton) {
      makeOrderButton.style.display = id ? 'inline-flex' : 'none';
    }
    if (cartMessage) {
      cartMessage.classList.add('hidden');
    }
  };

  window.closeImageModal = function(event) {
    // Se clicou no overlay (fora do modal)
    if (event && event.target.id === 'imageModal') {
      imageModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
    // Se clicou no botão X
    else if (!event || (event.target.closest('button') && !event.target.closest('.modal-content button'))) {
      imageModal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
  };

  window.openEstampaModal = function(button) {
    if (!button || !estampaModal) return;

    document.getElementById('modalImage').src = button.dataset.image || '';
    document.getElementById('modalImage').alt = button.dataset.title || 'Estampa';
    document.getElementById('modalTitle').textContent = button.dataset.title || 'Estampa';
    document.getElementById('modalDescription').textContent = button.dataset.description || 'Descrição da estampa.';
    document.getElementById('modalTechnique').textContent = button.dataset.technique || '-';
    document.getElementById('modalProduct').textContent = button.dataset.product || '-';
    document.getElementById('modalPrice').textContent = button.dataset.price || 'R$ 0,00';
    document.getElementById('modalTechniqueBadge').textContent = button.dataset.badge || button.dataset.technique || 'Estampa Premium';

    // Armazenar o ID da estampa
    likeCount = 0;
    isLiked = false;
    comments = [];
    if (commentInput) commentInput.value = '';
    if (commentPanel) commentPanel.classList.add('hidden');
    if (commentToggleButton) {
      commentToggleButton.classList.remove('bg-orange-500', 'text-black');
      commentToggleButton.classList.add('bg-transparent', 'text-orange-400');
    }
    updateLikeButton();
    renderComments();

    estampaModal.classList.remove('hidden');
    estampaModal.classList.add('flex');
    estampaModal.scrollTop = 0;
    const modalContent = estampaModal.querySelector('.modal-content');
    if (modalContent) modalContent.scrollTop = 0;
    document.body.style.overflow = 'hidden';

    modalData = {
      id: button.dataset.id, // Adicionado
      title: button.dataset.title || 'Estampa',
      description: button.dataset.description || 'Descrição da estampa.',
      technique: button.dataset.technique || '-',
      product: button.dataset.product || '-',
      price: button.dataset.price || 'R$ 0,00',
      image: button.dataset.image || ''
    };
  };

  window.openExpandedImage = function() {
    const modalImage = document.getElementById('modalImage');
    if (!expandedImageModal || !expandedModalImage || !modalImage?.src) return;

    expandedModalImage.src = modalImage.src;
    expandedModalImage.alt = modalImage.alt || 'Estampa ampliada';
    expandedImageModal.classList.remove('hidden');
    expandedImageModal.classList.add('flex');
  };

  window.closeExpandedImage = function(event) {
    if (event && event.target !== expandedImageModal) return;
    if (!expandedImageModal) return;

    expandedImageModal.classList.add('hidden');
    expandedImageModal.classList.remove('flex');
  };

  window.closeEstampaModal = function(event) {
    if (event && event.target !== estampaModal) return;
    if (!estampaModal) return;

    closeExpandedImage();
    estampaModal.classList.add('hidden');
    estampaModal.classList.remove('flex');
    document.body.style.overflow = '';
  };

  window.toggleCommentPanel = function() {
    const productDetailsPanel = document.getElementById('productDetailsPanel');
    if (!commentPanel || !productDetailsPanel) return;

    const isHidden = commentPanel.classList.contains('hidden');

    commentPanel.classList.toggle('hidden');
    commentPanel.classList.toggle('flex'); // Usar flex para a estrutura interna
    productDetailsPanel.classList.toggle('hidden');

    commentToggleButton?.classList.toggle('bg-orange-500', isHidden);
    commentToggleButton?.classList.toggle('text-black', isHidden);
    commentToggleButton?.classList.toggle('bg-transparent', !isHidden);
    if (isHidden) {
      setTimeout(() => commentInput?.focus(), 100);
    }
  };

  window.likeProduct = function() {
    const likeButton = document.getElementById('likeButton');

    if (!isLiked) {
      likeCount++;
      isLiked = true;
      likeButton?.classList.add('heart-liked');
      
      // Remover classe após animação
      setTimeout(() => {
        likeButton?.classList.remove('heart-liked');
      }, 500);
    } else {
      likeCount--;
      isLiked = false;
    }
    updateLikeButton();
  };

  function updateLikeButton() {
    const likeText = document.getElementById('likeText');
    const likeCount_display = document.getElementById('likeCount');
    const likeButton = document.getElementById('likeButton');
    
    if (!likeText || !likeCount_display || !likeButton) return;
    
    likeCount_display.textContent = `(${likeCount})`;
    
    if (isLiked) {
      likeButton.classList.add('bg-orange-500', 'text-black');
      likeButton.classList.remove('text-orange-500');
    } else {
      likeButton.classList.remove('bg-orange-500', 'text-black');
      likeButton.classList.add('text-orange-500');
    }
  }

  window.shareProduct = function() {
    const shareUrl = window.location.href;
    const title = modalData.title || 'Confira esta estampa incrível!';
    
    // Verificar se o navegador suporta Share API
    if (navigator.share) {
      navigator.share({
        title: 'SKO-TRAP - ' + title,
        text: 'Veja esta estampa amazing no SKO-TRAP!',
        url: shareUrl
      }).catch(err => console.log('Erro ao compartilhar:', err));
    } else {
      // Fallback: Copiar link para clipboard
      navigator.clipboard.writeText(shareUrl);
      alert('Link copiado para a área de transferência!');
    }
  };

  window.makeOrder = function() {
    if (modalData && modalData.id) {
      // Redireciona para a página de criação de pedido com o ID da estampa
      window.location.href = `/user/pedidos/novo/${modalData.id}`;
    } else {
      alert('Não foi possível identificar a estampa. Por favor, tente novamente.');
      console.error('Estampa ID is missing from modalData.');
    }
  };

  window.addToCart = function() {
    if (!modalData || !modalData.id) {
      alert('Não foi possível identificar a estampa. Por favor, tente novamente.');
      return;
    }

    const cart = getCart();
    const existing = cart.find(item => item.id === modalData.id);

    if (existing) {
      existing.quantity += 1;
    } else {
      cart.push({
        id: modalData.id,
        title: modalData.title || 'Estampa',
        description: modalData.description || '',
        product: modalData.product || '',
        price: modalData.price || 'R$ 0,00',
        image: modalData.image || '',
        quantity: 1
      });
    }

    saveCart(cart);
    updateCartBadge();
    renderCartInPedidos();
    showCartMessage(`${modalData.title || 'Estampa'} adicionada aos seus pedidos.`);
  };

  function getCart() {
    try {
      return JSON.parse(localStorage.getItem('sko_trap_cart') || '[]');
    } catch (error) {
      console.error('Falha ao ler o carrinho:', error);
      return [];
    }
  }

  function saveCart(cart) {
    localStorage.setItem('sko_trap_cart', JSON.stringify(cart));
  }

  function updateCartBadge() {
    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + (Number(item.quantity) || 0), 0);
    const badges = document.querySelectorAll('[id^="cartCountBadge"]');

    if (!badges.length) return;

    badges.forEach((badge) => {
      if (totalItems > 0) {
        badge.textContent = totalItems;
        badge.classList.remove('hidden');
      } else {
        badge.textContent = '0';
        badge.classList.add('hidden');
      }
    });
  }

  function showCartMessage(message) {
    if (!cartMessage) return;
    cartMessage.textContent = message;
    cartMessage.classList.remove('hidden');
    cartMessage.classList.add('text-emerald-300');
    setTimeout(() => {
      cartMessage.classList.add('hidden');
    }, 3000);
  }

  function removeFromCart(id) {
    const cart = getCart().filter(item => item.id !== id);
    saveCart(cart);
    updateCartBadge();
    renderCartInPedidos();
  }

  window.removeFromCart = removeFromCart;
  window.updateCartQuantity = updateCartQuantity;
  window.clearCart = clearCart;
  window.checkoutCartWithWhatsApp = checkoutCartWithWhatsApp;
  window.renderCartInPedidos = renderCartInPedidos;

  function updateCartQuantity(id, delta) {
    const cart = getCart();
    const item = cart.find(entry => entry.id === id);

    if (!item) return;

    item.quantity = Math.max(1, item.quantity + delta);
    saveCart(cart);
    updateCartBadge();
    renderCartInPedidos();
  }

  function clearCart() {
    saveCart([]);
    updateCartBadge();
    renderCartInPedidos();
  }

  function formatCurrency(value) {
    return `MZN ${value.toFixed(2).replace('.', ',')}`;
  }

  function getCartItemPrice(item) {
    const raw = String(item.price || '0');
    const normalized = raw.replace(/[^0-9,\.]/g, '').replace('.', '').replace(',', '.');
    const numeric = parseFloat(normalized) || 0;
    return numeric;
  }

  function checkoutCartWithWhatsApp() {
    const cart = getCart();

    if (!cart.length) {
      alert('Seu carrinho está vazio. Adicione uma estampa antes de confirmar.');
      return;
    }

    const storeWhatsapp = window.storeWhatsappNumber || '258873182096';
    const userName = window.userData?.nome || 'Cliente';
    const userPhone = window.userData?.telefone || 'Não informado';

    const lines = [
      'Olá! 👋',
      `Meu nome é ${userName} e gostaria de confirmar meu pedido:`,
      `Telefone de contato: ${userPhone}`,
      ''
    ];

    cart.forEach((item, index) => {
      lines.push(`${index + 1}. *${item.title}*`);
      lines.push(`   - Quantidade: ${item.quantity}`);
      lines.push(`   - Valor unitário: ${item.price}`);
      lines.push(`   - Subtotal: ${formatCurrency(getCartItemPrice(item) * item.quantity)}`);
      lines.push(`   - Imagem: ${item.image || 'Sem imagem disponível'}`);
      lines.push('');
    });

    const total = cart.reduce((sum, item) => sum + getCartItemPrice(item) * item.quantity, 0);
    lines.push(`*Total do pedido:* ${formatCurrency(total)}`);
    lines.push('');
    lines.push('Agradeço e aguardo as próximas instruções!');

    const message = lines.join('\n');
    const whatsappUrl = `https://wa.me/${storeWhatsapp}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
  }

  function renderCartInPedidos() {
    const cartContainer = document.getElementById('cartItemsContainer');
    const clearCartButton = document.getElementById('clearCartButton');
    const checkoutCartButton = document.getElementById('checkoutCartButton');

    if (!cartContainer) return;

    const cart = getCart();

    if (clearCartButton) {
      clearCartButton.onclick = clearCart;
    }

    if (checkoutCartButton) {
      checkoutCartButton.onclick = checkoutCartWithWhatsApp;
    }

    if (!cart.length) {
      cartContainer.innerHTML = `
        <div class="rounded-3xl border border-zinc-200/80 bg-white p-6 text-zinc-600">
          <h3 class="text-lg font-semibold text-zinc-900 mb-3">Carrinho vazio</h3>
          <p class="text-sm">Seu carrinho está vazio. Adicione estampas na página de catálogo para vê-las aqui.</p>
        </div>
      `;
      return;
    }

    const rowsHtml = cart.map(item => {
      const unitPrice = getCartItemPrice(item);
      const subtotal = unitPrice * item.quantity;

      return `
        <tr class="border-b border-zinc-200/80 hover:bg-zinc-50">
          <td class="px-4 py-4">
            <div class="flex items-center gap-4">
              <img src="${item.image}" alt="${item.title}" class="w-16 h-16 rounded-xl object-cover border border-zinc-200" />
              <div>
                <p class="font-semibold text-zinc-900">${item.title}</p>
                <p class="text-sm text-zinc-500">${item.product || 'Estampa'}</p>
              </div>
            </div>
          </td>
          <td class="px-4 py-4 text-center">
            <div class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-zinc-50 px-2 py-1">
              <button onclick="updateCartQuantity('${item.id}', -1)" class="h-7 w-7 rounded-full border border-zinc-300 bg-white text-zinc-700">-</button>
              <span class="min-w-6 text-center text-zinc-700 font-semibold">${item.quantity}</span>
              <button onclick="updateCartQuantity('${item.id}', 1)" class="h-7 w-7 rounded-full border border-zinc-300 bg-white text-zinc-700">+</button>
            </div>
          </td>
          <td class="px-4 py-4 text-center text-orange-500 font-semibold">${item.price}</td>
          <td class="px-4 py-4 text-center text-zinc-700">${formatCurrency(subtotal)}</td>
          <td class="px-4 py-4 text-center">
            <button onclick="removeFromCart('${item.id}')" class="px-3 py-2 rounded-full border border-zinc-300 text-zinc-600 hover:bg-zinc-100 transition">Remover</button>
          </td>
        </tr>
      `;
    }).join('');

    const totalPrice = cart.reduce((sum, item) => sum + getCartItemPrice(item) * item.quantity, 0);

    cartContainer.innerHTML = `
      <div class="rounded-3xl border border-zinc-200/80 bg-white overflow-hidden mb-8">
        <div class="bg-zinc-100 px-6 py-4 border-b border-zinc-200">
          <h3 class="text-xl font-bold text-zinc-900">Itens do carrinho</h3>
          <p class="text-sm text-zinc-500">Confira aqui as estampas adicionadas antes de confirmar seu pedido.</p>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-zinc-200">
            <thead class="bg-white text-left text-xs uppercase tracking-wider text-zinc-500">
              <tr>
                <th class="px-4 py-3">Produto</th>
                <th class="px-4 py-3 text-center">Qtd</th>
                <th class="px-4 py-3 text-center">Preço unit.</th>
                <th class="px-4 py-3 text-center">Subtotal</th>
                <th class="px-4 py-3 text-center">Ação</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              ${rowsHtml}
            </tbody>
            <tfoot class="bg-zinc-50">
              <tr>
                <td colspan="3" class="px-4 py-4 text-right font-semibold text-zinc-600">Total estimado:</td>
                <td class="px-4 py-4 text-center text-orange-500 font-bold">${formatCurrency(totalPrice)}</td>
                <td class="px-4 py-4"></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    `;
  }

  document.addEventListener('DOMContentLoaded', function() {
    updateCartBadge();
    renderCartInPedidos();
  });

  window.addComment = function() {
    if (!commentInput) return;
    const text = commentInput.value.trim();
    
    if (text === '') {
      alert('Por favor, escreva um comentário!');
      return;
    }

    // Adicionar comentário
    const comment = {
      id: Date.now(),
      author: 'Usuário',
      text: text,
      timestamp: new Date().toLocaleTimeString('pt-pt', { hour: '2-digit', minute: '2-digit' })
    };

    comments.unshift(comment);
    commentInput.value = '';
    renderComments();
  };

  function renderComments() {
    if (!commentsList) return;
    
    if (comments.length === 0) {
      commentsList.innerHTML = '<p class="text-center text-gray-500 text-sm py-4">Sem comentários ainda. Seja o primeiro!</p>';
      return;
    }

    commentsList.innerHTML = comments.map(comment => `
      <div class="comment-item bg-zinc-900 border border-zinc-800 rounded-lg p-4">
        <div class="flex items-start justify-between mb-2">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-orange-500/20 text-orange-400 flex items-center justify-center text-xs font-bold">
              <i class="fas fa-user-circle"></i>
            </div>
            <div>
              <p class="text-sm font-semibold text-white">${comment.author}</p>
              <p class="text-xs text-gray-500">${comment.timestamp}</p>
            </div>
          </div>
          <button onclick="deleteComment(${comment.id})" class="text-gray-500 hover:text-red-500 text-xs transition-colors">
            <i class="fas fa-trash"></i>
          </button>
        </div>
        <p class="text-sm text-gray-300 leading-relaxed">${comment.text}</p>
      </div>
    `).join('');
  }

  window.deleteComment = function(id) {
    comments = comments.filter(c => c.id !== id);
    renderComments();
  };

  function getTechniqueDescription(technique) {
    const descriptions = {
      'DTG': 'Direct-to-Garment (DTG) - Impressão direta com altíssima qualidade',
      'DTF': 'Direct-to-Film (DTF) - Transfer de alta definição e durabilidade',
      'BORDADO': 'Bordado Industrial - Acabamento luxuoso e sofisticado',
      'SUBLIMAÇÃO': 'Sublimação - Cores intensas e imperceptíveis ao toque',
      'SERIGRAFIA': 'Serigrafia - Cores sólidas e vibrantes'
    };
    return descriptions[technique] || technique;
  }

  document.addEventListener('click', (event) => {
    if (estampaModal && estampaModal.classList.contains('flex') && event.target === estampaModal) {
      closeEstampaModal();
    }
  });

  // Fechar modal com tecla ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      if (imageModal && !imageModal.classList.contains('hidden')) {
        closeImageModal();
      }
      if (estampaModal && !estampaModal.classList.contains('hidden')) {
        closeEstampaModal();
      }
    }
  });

  console.log('%c✅ SKO-TRAP animations loaded successfully!', 'color: #f97316; font-weight: bold');
});