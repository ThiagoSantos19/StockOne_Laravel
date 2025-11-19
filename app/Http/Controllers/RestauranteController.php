<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function index()
    {
        $restaurantes = Restaurante::orderBy('nome')->paginate(12);

        return view('restaurantes.index', compact('restaurantes'));
    }

    public function create()
    {
        return view('restaurantes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:18'],
            'endereco' => ['nullable', 'string'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        Restaurante::create($data);

        return redirect()->route('restaurantes.index')->with('success', 'Restaurante cadastrado com sucesso.');
    }

    public function edit(Restaurante $restaurante)
    {
        return view('restaurantes.edit', compact('restaurante'));
    }

    public function update(Request $request, Restaurante $restaurante)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:18'],
            'endereco' => ['nullable', 'string'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $restaurante->update($data);

        return redirect()->route('restaurantes.index')->with('success', 'Restaurante atualizado com sucesso.');
    }

    public function destroy(Restaurante $restaurante)
    {
        $restaurante->delete();

        return redirect()->route('restaurantes.index')->with('success', 'Restaurante removido com sucesso.');
    }
}
