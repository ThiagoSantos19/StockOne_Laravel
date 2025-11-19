<?php

namespace App\Http\Controllers;

use App\Models\CompraSugestao;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompraSugestaoController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $sugestoes = CompraSugestao::with('insumo')
            ->whereHas('insumo', fn ($query) => $query->where('restaurante_id', $restauranteId))
            ->orderByDesc('data_geracao')
            ->paginate(15);

        return view('compras_sugestoes.index', compact('sugestoes'));
    }

    public function create()
    {
        $insumos = $this->insumosDoRestaurante();

        return view('compras_sugestoes.create', compact('insumos'));
    }

    public function store(Request $request)
    {
        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
            ],
            'quantidade_sugerida' => ['required', 'numeric'],
            'justificativa' => ['nullable', 'string'],
            'status' => ['required', 'string', 'max:50'],
            'periodo_analise_dias' => ['nullable', 'integer', 'min:0'],
            'data_geracao' => ['required', 'date'],
        ]);

        CompraSugestao::create($data);

        return redirect()->route('compras-sugestoes.index')->with('success', 'Sugestão de compra registrada com sucesso.');
    }

    public function edit(CompraSugestao $compraSugestao)
    {
        $this->authorizeSugestao($compraSugestao);

        $insumos = $this->insumosDoRestaurante();

        return view('compras_sugestoes.edit', [
            'sugestao' => $compraSugestao,
            'insumos' => $insumos,
        ]);
    }

    public function update(Request $request, CompraSugestao $compraSugestao)
    {
        $this->authorizeSugestao($compraSugestao);

        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
            ],
            'quantidade_sugerida' => ['required', 'numeric'],
            'justificativa' => ['nullable', 'string'],
            'status' => ['required', 'string', 'max:50'],
            'periodo_analise_dias' => ['nullable', 'integer', 'min:0'],
            'data_geracao' => ['required', 'date'],
        ]);

        $compraSugestao->update($data);

        return redirect()->route('compras-sugestoes.index')->with('success', 'Sugestão de compra atualizada com sucesso.');
    }

    public function destroy(CompraSugestao $compraSugestao)
    {
        $this->authorizeSugestao($compraSugestao);

        $compraSugestao->delete();

        return redirect()->route('compras-sugestoes.index')->with('success', 'Sugestão de compra removida com sucesso.');
    }

    protected function authorizeSugestao(CompraSugestao $compraSugestao): void
    {
        abort_unless(optional($compraSugestao->insumo)->restaurante_id === $this->restauranteId(), 403);
    }

    protected function insumosDoRestaurante()
    {
        return Insumo::where('restaurante_id', $this->restauranteId())
            ->orderBy('nome')
            ->pluck('nome', 'id');
    }
}
