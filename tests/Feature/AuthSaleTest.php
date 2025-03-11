<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthSaleTest extends TestCase
{
    use RefreshDatabase; // Para limpar o banco de testes

    public function test_sales_user_can_be_created()
    {
        $salesUser = User::factory()->create([
            'name' => 'Sales User',
            'email' => 'sales@example.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_SALES, // Verifica se o role está correto
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'sales@example.com',
            'role' => User::ROLE_SALES
        ]);
    }

    public function test_saler_can_login_with_valid_credentials()
    {
        // Criando um usuário no banco de testes
        $saler = User::factory()->create([
            'email' => 'user@user.com',
            'password' => bcrypt('password123'),
            'role' => User::ROLE_SALES,
        ]);

        // Enviando a requisição POST para login
        $response = $this->post('/sales/login', [
            'email' => 'user@user.com',
            'password' => 'password123',
            'role' => 'sales',
        ]);

        // Verificando se foi autenticado e redirecionado corretamente
        $response->assertRedirect('/menu');
        $this->assertAuthenticatedAs($saler);
    }

    /** @test */
    public function saler_cannot_login_with_invalid_credentials()
    {
        $saler = User::factory()->create([
            'email' => 'user@exemplo.com',
            'password' => bcrypt('password123'),
            'role' => User::ROLE_SALES,
        ]);

        // Tentando logar com uma senha incorreta
        $response = $this->post('/sales/login', [
            'email' => 'user@exemplo.com',
            'password' => 'wrongpassword',
            'role' => User::ROLE_SALES,
        ]);

        // Deve redirecionar de volta com erro
        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    // /** @test */
    // public function saler_cannot_access_protected_route_without_authentication()
    // {
    //     // Tentando acessar uma rota protegida sem estar logado
    //     $response = $this->get('/menu');

    //     // Deve redirecionar para a página de login
    //     $response->assertRedirect('/login');
    // }

    // /** @test */
    // public function authenticated_saler_can_logout()
    // {
    //     $saler = User::factory()->create();

    //     // Autenticando o usuário
    //     $this->actingAs($saler);

    //     // Enviando a requisição de logout
    //     $response = $this->post('/logout');

    //     // Verificando se foi deslogado corretamente
    //     $this->assertGuest();
    //     $response->assertRedirect('/');
    // }
}
