<?php

namespace App\Http\Controllers;

use App\Models\CardapioItem;
use App\Models\Restaurante;
use App\Support\PublicCart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PublicMenuController extends Controller
{
    public function index(Request $request)
    {
        $restaurante = Restaurante::first();

        abort_unless($restaurante, 404, 'Restaurante não configurado.');

        $itens = CardapioItem::where('restaurante_id', $restaurante->id)
            ->where('ativo_online', true)
            ->orderBy('categoria')
            ->orderBy('nome')
            ->get()
            ->groupBy(fn ($item) => $item->categoria ?: 'Sugestões da casa');

        $cartItems = PublicCart::all();
        $suggestions = $this->buildSuggestions($restaurante->id, $cartItems);

        return view('public.menu', [
            'restaurante' => $restaurante,
            'categorias' => $itens,
            'cartItems' => $cartItems,
            'cartTotal' => PublicCart::subtotal(),
            'cartCount' => PublicCart::itemsCount(),
            'suggestions' => $suggestions,
        ]);
    }

    protected function buildSuggestions(int $restauranteId, Collection $cartItems): Collection
    {
        $cartCategories = $cartItems
            ->pluck('categoria')
            ->filter()
            ->unique()
            ->values();

        $query = CardapioItem::where('restaurante_id', $restauranteId)
            ->where('ativo_online', true)
            ->whereNotIn('id', $cartItems->pluck('id')->all());

        if ($cartCategories->isNotEmpty()) {
            $query->whereIn('categoria', $cartCategories->all());
        }

        return $query
            ->orderByDesc('updated_at')
            ->limit(4)
            ->get();
    }
}


