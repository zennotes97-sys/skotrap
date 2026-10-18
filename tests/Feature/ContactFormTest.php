<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_sends_email(): void
    {
        Mail::fake();

        $response = $this->from('/')->post('/contato', [
            'nome' => 'João Silva',
            'email' => 'joao@exemplo.com',
            'assunto' => 'Orçamento de Estamparia (DTG / DTF)',
            'mensagem' => 'Quero um orçamento para 200 camisetas.',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Mensagem enviada com sucesso!');

        Mail::assertSent(function (\Illuminate\Mail\Message $mail) {
            return $mail->hasTo(config('mail.from.address'))
                && str_contains($mail->subject, 'Novo contacto');
        });
    }
}
