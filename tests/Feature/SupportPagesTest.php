<?php

namespace Tests\Feature;

use Tests\TestCase;

class SupportPagesTest extends TestCase
{
    public function test_support_pages_are_public_and_render_their_titles(): void
    {
        $pages = [
            '/faqs' => 'Perguntas frequentes',
            '/prazos-de-entrega' => 'Prazos de Entrega',
            '/prazos-de-envio' => 'Prazos de Envio',
            '/guia-de-tamanhos' => 'Guia de Tamanhos',
            '/politica-de-trocas' => 'Política de Trocas',
            '/termos-de-servico' => 'Termos de Serviço',
        ];

        foreach ($pages as $uri => $title) {
            $this->get($uri)
                ->assertOk()
                ->assertSee($title);
        }
    }
}
