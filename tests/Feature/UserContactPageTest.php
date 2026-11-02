<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserContactPageTest extends TestCase
{
    public function test_user_contact_page_loads_with_svg_icon_and_form(): void
    {
        $user = new User();
        $user->id = 1;
        $user->nome = 'Cliente Teste';
        $user->email = 'cliente@teste.com';
        $user->telefone = '258841234567';
        $user->role = 'user';

        $response = $this->actingAs($user)->get(route('user.contato'));

        $response->assertOk();
        $response->assertSee('svg', false);
        $response->assertSee('Entre em contacto');
    }
}
