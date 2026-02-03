<?php

namespace App\Http\Controllers;
use App\Models\Entidades;
use Illuminate\Http\Request;

class EntidadesController extends Controller
{
    protected int $max_paginate = 10;

    /**
     * Mostrar todos los Entidades
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todas los Entidades
     */
    public function index(){
        $Entidades = Entidades::paginate($this->max_paginate);
        return response()->json($Entidades);
    }

    /**
     * Mostrar una entidad por ID
     * 
     * 
     */
    public function show($id){
        $entidad = Entidades::findOrFail($id);
        return response()->json($entidad);
    }

    /**
     * Crear una entidad
     */
    public function store(Request $request){
        $entidad = Entidades::create($request->all());
        return response()->json($entidad);
    }

    /**
     * Actualizar una entidad
     */
    public function update(Request $request, $id){
        $entidad = Entidades::findOrFail($id);
        $entidad->update($request->all());
        return response()->json($entidad);
    }

    /**
     * Borrar una entidad
     */
    public function destroy($id){
        $entidad = Entidades::findOrFail($id);
        $entidad->delete();
        return response()->json(null, 204);
    }
}
