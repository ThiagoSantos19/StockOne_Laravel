<?php

namespace Tests\Feature;

use App\Models\Restaurante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $restaurante = Restaurante::create([
            'nome' => 'Restaurante Teste',
            'cnpj' => '00.000.000/0000-00',
            'endereco' => 'Rua Teste, 123',
            'telefone' => '(11) 0000-0000',
            'email' => 'teste@example.com',
            'status' => 'ativo',
        ]);

        $response = $this->withSession([
            'restaurante_id' => $restaurante->id,
            'restaurante_nome' => $restaurante->nome,
        ])->get('/dashboard');

        $response->assertOk()->assertSee('StockOne');
    }
}
