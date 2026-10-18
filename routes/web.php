<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\Estampa;

// Rota Principal
Route::get('/', function () {
    $estampas = Estampa::where('ativo', true)->latest('id')->take(8)->get();

    $maisPedidosIds = DB::table('pedido_itens')
        ->select('estampa_id', DB::raw('SUM(quantidade) as total_vendido'))
        ->groupBy('estampa_id')
        ->orderByDesc('total_vendido')
        ->limit(2)
        ->pluck('estampa_id')
        ->toArray();

    if (!empty($maisPedidosIds)) {
        $servicosTecnicas = Estampa::where('ativo', true)
            ->whereIn('id', $maisPedidosIds)
            ->orderByRaw('FIELD(id, '.implode(',', $maisPedidosIds).')')
            ->get();
    } else {
        $servicosTecnicas = collect();
    }

    if ($servicosTecnicas->count() < 2) {
        $servicosTecnicas = Estampa::where('ativo', true)->latest('id')->skip(4)->take(2)->get();
    }

    return view('welcome', compact('estampas', 'servicosTecnicas'));
})->name('home');

Route::get('/estampas', function () {
    $estampas = \App\Models\Estampa::where('ativo', true)->latest('id')->get();

    $promocoesAtivas = \App\Models\Promocao::with('estampa')
        ->where('ativo', true)
        ->where(function ($query) {
            $query->whereNull('fim')
                ->orWhere('fim', '>=', now());
        })
        ->where('inicio', '<=', now())
        ->latest('id')
        ->get();

    return view('estampas', compact('estampas', 'promocoesAtivas'));
})->name('estampas');

Route::post('/contato', [UserController::class, 'storeContato'])->name('contato.store');

// Páginas públicas de ajuda e informação
Route::view('/faqs', 'faqs')->name('support.faqs');
Route::view('/prazos-de-entrega', 'prazos')->name('support.prazos');
Route::view('/prazos-de-envio', 'prazos_de_envio')->name('support.envio');
Route::view('/guia-de-tamanhos', 'guias_de_tamanho')->name('support.tamanhos');
Route::view('/politica-de-trocas', 'politica_de_trocas')->name('support.trocas');
Route::view('/termos-de-servico', 'termos_de_servicos')->name('support.termos');

// Rotas acessíveis apenas para VISITANTES (Quem NÃO está logado)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::get('/registro', function () { return view('auth.registro'); })->name('registro');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/registro', [AuthController::class, 'registro']);
});

// Rotas protegidas (Apenas para usuários autenticados)
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Painel do Usuário Comum
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/estampas', [UserController::class, 'estampas'])->name('estampas');
        
        // Exibe o formulário do perfil
        Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');
        
        // Dentro de Route::prefix('user')->name('user.')->group(function () { ...
        Route::get('/compras', [UserController::class, 'compras'])->name('compras');

        // ADICIONADO: Processa a atualização dos dados do perfil (PUT)
        Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');
        
        Route::get('/pedidos', [UserController::class, 'pedidos'])->name('pedidos');

        // ROTA PARA CRIAR UM NOVO PEDIDO
        Route::get('/pedidos/novo/{estampa}', [UserController::class, 'criarPedido'])->name('pedidos.criar');

        // Dentro de Route::prefix('user')->name('user.')->group(function () { ...
    Route::get('/mensagens', [UserController::class, 'mensagens'])->name('mensagens');
    Route::post('/mensagens/{id}/enviar', [UserController::class, 'enviarMensagem'])->name('mensagens.enviar');
    });

    // Painel Administrativo
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/estampas', [AdminController::class, 'storeEstampa'])->name('estampas.store');
        Route::get('/compras', [AdminController::class, 'compras'])->name('compras');
        Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('pedidos');
        Route::get('/mensagens', [AdminController::class, 'mensagens'])->name('mensagens');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
        Route::get('/relatorios', [AdminController::class, 'relatorios'])->name('relatorios');
        Route::get('/usuarios/{id}/edit', [AdminController::class, 'editUsuario'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [AdminController::class, 'updateUsuario'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [AdminController::class, 'destroyUsuario'])->name('usuarios.destroy');
        Route::get('/configuracoes', [AdminController::class, 'configuracoes'])->name('configuracoes');
        Route::get('/estampas', [AdminController::class, 'estampas'])->name('estampas');
        Route::get('/estampas/{id}/edit', [AdminController::class, 'editarEstampa'])->name('estampas.edit');
        Route::get('/estampas/{id}/editar', [AdminController::class, 'editarEstampa'])->name('estampas.editar');
        Route::put('/estampas/{id}', [AdminController::class, 'atualizarEstampa'])->name('estampas.update');
        Route::delete('/estampas/{id}', [AdminController::class, 'destroyEstampa'])->name('estampas.destroy');
        Route::get('/produtos', [AdminController::class, 'produtos'])->name('produtos');
        Route::get('/promocoes', [AdminController::class, 'promocoes'])->name('promocoes');
        Route::post('/promocoes', [AdminController::class, 'storePromocao'])->name('promocoes.store');
        Route::delete('/promocoes/{id}', [AdminController::class, 'destroyPromocao'])->name('promocoes.destroy');
    });
});