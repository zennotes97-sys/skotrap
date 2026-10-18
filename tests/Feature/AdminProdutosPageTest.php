<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProdutosPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_produtos_page_loads(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.produtos'));

        $response->assertOk();
    }
}
