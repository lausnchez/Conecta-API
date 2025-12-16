<?php

namespace App\Http\Controllers;
use App\Models\Eventos;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function prueba(){
        return "Eventos prueba";
    }

    public function getAll(){
        $eventos = Eventos::getAllEventos();
        return response()->json($eventos);       
    }

    public function getEventoById($id){
        // $evento = Eventos::getEventoById($id);
        // return response()->json($evento);
        return Eventos::with('categoria')->findOrFail($id);
    }
}
