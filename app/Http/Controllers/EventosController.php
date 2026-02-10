<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventosRequest;
use App\Http\Requests\UpdateEventosRequest;
use App\Models\Eventos;
use Illuminate\Http\Request;

class EventosController extends Controller
{

    protected int $max_paginate = 10;

    /**
     * Mostrar todos los Eventos
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todos los Eventos
     */
    public function index(){
        $Eventos = Eventos::with([
            'categoria:id,nombre',
            'entidad:id,nombre,es_accesible',
            'creador:id,username,email,nombre,apellido',
            'tags'
            ])->paginate($this->max_paginate);
        return response()->json($Eventos);
    }

    /**
     * Método para los eventos en web con los datos necesarios
     */
    public function indexweb(){
        // Fecha de inicio, nombre, ubicación 
        $Eventos = Eventos::select([
            'id',
            'nombre',
            'fecha_inicio_evento',
            'ubicacion',
            'es_accesible',
            'id_categoria',
            'id_entidad',
            'id_creador',
        ])->with([
            'categoria:id,nombre',
            'entidad:id,nombre',
            'creador:id,username',
            'tags:id,nombre'
        ])->paginate($this->max_paginate);

        // Ocultar las foreign keys en cada evento
        $Eventos->getCollection()->transform(function ($evento) {
            return $evento->makeHidden(['id_categoria', 'id_entidad', 'id_creador']);
        });

        return response()->json($Eventos);      
    }

    /**
     * 
     */
    public function show($id){
        $Eventos = Eventos::with([
            'categoria:id,nombre',
            'entidad:id,nombre,es_accesible',
            'creador:id,username,email,nombre,apellido',
            'tags'
            ])->findOrFail($id);
        return response()->json($Eventos);
    }

    /**
     * Crear un evento
     */
    public function store(StoreEventosRequest $request){
        $data = $request->validated();
        $evento = Eventos::create($data);
        return response()->json($evento, 201);
    }

    /**
     * 
     */
    public function update(UpdateEventosRequest $request, $id){
        $data = $request->validated();
        $evento = Eventos::findOrFail($id);
        $evento->update($data);
        return response()->json($evento, 200);
    }

    /**
     * 
     */
    public function destroy($id){
        $tag = Eventos::findOrFail($id);
        $tag->delete();
        return response()->json(null, 204);
    }

    // MÉTODOS ESPECÍFICOS
    //---------------------------------------------------------

    /**
     * Recoge eventos accesibles
     */
    public function esAccesible(){
        $eventos = Eventos::accesibilidad(true)->with(
            ['categoria:id,nombre',
            'entidad:id,nombre',
            'creador:id,username,email',
            'tags',
            'aplicacion'])
            ->paginate($this->max_paginate);

        $eventos->getCollection()->transform(function ($evento) {
            return $evento->makeHidden([
                'id_categoria',
                'id_entidad',
                'id_creador',
                'id_aplicacion'
                ]);
        });

        return response()->json($eventos);
    }
}
