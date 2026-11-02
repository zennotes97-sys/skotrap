<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class WhatsAppCartClearTest extends TestCase
{
    public function test_whatsapp_order_confirmation_clears_local_cart(): void
    {
        $user = new User();
        $user->nome = 'Cliente Teste';
        $user->telefone = '258841234567';

        $estampa = (object) [
            'nome' => 'Estampa para teste',
            'descricao' => 'Descrição do pedido.',
            'preco' => 250.00,
            'imagem' => '',
            'ativo' => true,
        ];

        $this->actingAs($user);

        $html = view('user.pedido-create', compact('estampa'))->render();

        $this->assertStringContainsString("localStorage.removeItem('sko_trap_cart')", $html);
    }
}
