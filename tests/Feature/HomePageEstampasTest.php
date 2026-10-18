<?php

namespace Tests\Feature;

use App\Models\Estampa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageEstampasTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_lists_active_estampas_and_price_in_modal(): void
    {
        Estampa::create([
            'nome' => 'Floral Explosion',
            'slug' => 'floral-explosion',
            'descricao' => 'Camiseta branca com estampa total em padrão floral...',
            'preco' => 120.00,
            'imagem' => 'estampas/floral.png',
            'tecnica' => 'DTF',
            'produto' => 'Camiseta branca',
            'ativo' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Floral Explosion');
        $response->assertSee('data-price="R$ 120,00"', false);
    }
}
