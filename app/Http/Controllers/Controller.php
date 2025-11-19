<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function restauranteId(): int
    {
        return (int) session('restaurante_id');
    }

    protected function restauranteNome(): ?string
    {
        return session('restaurante_nome');
    }
}
