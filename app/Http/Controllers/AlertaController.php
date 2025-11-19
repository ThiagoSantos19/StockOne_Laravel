<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlertaController extends Controller
{
    public function index()
    {
        $restauranteId = $this->restauranteId();

        $alertas = Alerta::with('insumo')
            ->whereHas('insumo', fn ($query) => $query->where('restaurante_id', $restauranteId))
            ->orderByDesc('data_hora_alerta')
            ->paginate(15);

        return view('alertas.index', compact('alertas'));
    }

    public function create()
    {
        $insumos = $this->insumosDoRestaurante();

        return view('alertas.create', compact('insumos'));
    }

    public function store(Request $request)
    {
        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
            ],
            'tipo_alerta' => ['required', 'string', 'max:100'],
            'mensagem' => ['required', 'string'],
            'data_hora_alerta' => ['nullable', 'date'],
            'visualizado' => ['nullable', 'boolean'],
            'resolvido' => ['nullable', 'boolean'],
        ]);

        $data['visualizado'] = $request->boolean('visualizado');
        $data['resolvido'] = $request->boolean('resolvido');

        Alerta::create($data);

        return redirect()->route('alertas.index')->with('success', 'Alerta criado com sucesso.');
    }

    public function edit(Alerta $alerta)
    {
        $this->authorizeAlerta($alerta);

        $insumos = $this->insumosDoRestaurante();

        return view('alertas.edit', compact('alerta', 'insumos'));
    }

    public function update(Request $request, Alerta $alerta)
    {
        $this->authorizeAlerta($alerta);

        $restauranteId = $this->restauranteId();

        $data = $request->validate([
            'insumo_id' => [
                'required',
                Rule::exists('insumos', 'id')->where('restaurante_id', $restauranteId),
            ],
            'tipo_alerta' => ['required', 'string', 'max:100'],
            'mensagem' => ['required', 'string'],
            'data_hora_alerta' => ['nullable', 'date'],
            'visualizado' => ['nullable', 'boolean'],
            'resolvido' => ['nullable', 'boolean'],
        ]);

        $data['visualizado'] = $request->boolean('visualizado');
        $data['resolvido'] = $request->boolean('resolvido');

        $alerta->update($data);

        return redirect()->route('alertas.index')->with('success', 'Alerta atualizado com sucesso.');
    }

    public function destroy(Alerta $alerta)
    {
        $this->authorizeAlerta($alerta);

        $alerta->delete();

        return redirect()->route('alertas.index')->with('success', 'Alerta removido com sucesso.');
    }

    protected function authorizeAlerta(Alerta $alerta): void
    {
        abort_unless(optional($alerta->insumo)->restaurante_id === $this->restauranteId(), 403);
    }

    protected function insumosDoRestaurante()
    {
        return Insumo::where('restaurante_id', $this->restauranteId())
            ->orderBy('nome')
            ->pluck('nome', 'id');
    }
}
