<?php

use App\Http\Controllers\AlertaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardapioItemController;
use App\Http\Controllers\CompraSugestaoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FilaProducaoController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoItemController;
use App\Http\Controllers\PublicCartController;
use App\Http\Controllers\PublicMenuController;
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return session()->has('restaurante_id')
        ? redirect()->route('dashboard')
        : redirect()->route('auth.login');
});

Route::get('/menu', [\App\Http\Controllers\PublicMenuController::class, 'index'])->name('public.menu');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.submit');

Route::post('/carrinho', [PublicCartController::class, 'store'])->name('public.cart.store');
Route::patch('/carrinho/{cardapioItemId}', [PublicCartController::class, 'update'])->name('public.cart.update');
Route::delete('/carrinho/{cardapioItemId}', [PublicCartController::class, 'destroy'])->name('public.cart.destroy');
Route::post('/carrinho/finalizar', [PublicCartController::class, 'checkout'])->name('public.cart.checkout');

Route::middleware('restaurante.session')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('insumos', InsumoController::class)->except(['show']);
    Route::resource('cardapio-itens', CardapioItemController::class)
        ->parameters(['cardapio-itens' => 'cardapio_item'])
        ->except(['show']);
    Route::resource('pedidos', PedidoController::class)->except(['show']);
    Route::resource('estoque', EstoqueController::class)->except(['show']);
    Route::resource('alertas', AlertaController::class)->except(['show']);
    Route::resource('compras-sugestoes', CompraSugestaoController::class)->except(['show']);
    Route::resource('receitas', ReceitaController::class)->except(['show']);
    Route::resource('pedido-itens', PedidoItemController::class)->except(['show']);
    Route::resource('fila-producao', FilaProducaoController::class)->except(['show']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
