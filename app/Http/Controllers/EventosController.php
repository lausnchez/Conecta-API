<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function prueba(){
        return "Eventos prueba";
    }

    public function getAll(){
        $eventos = \App\Models\Eventos::getAllEventos();
        return response()->json($eventos);
    }
}
