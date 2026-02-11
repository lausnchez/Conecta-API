<?php

namespace App\Http\Controllers;

use App\Models\Aplicaciones;
use Illuminate\Http\Request;

class AplicacionesController extends Controller
{
    protected int $max_paginate = 10;

    /**
     * Mostrar todos los Aplicaciones
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todos los Aplicaciones
     */
    public function index(){
        $Aplicaciones = Aplicaciones::all();
        return response()->json($Aplicaciones);
    }

    /**
     * Mostrar un app por ID
     * 
     * 
     */
    public function show($id){
        $app = Aplicaciones::findOrFail($id);
        return response()->json($app);
    }

    /**
     * Crear un app
     */
    public function store(Request $request){
        $app = Aplicaciones::create($request->all());
        return response()->json($app);
    }

    /**
     * 
     */
    public function update(Request $request, $id){
        $app = Aplicaciones::findOrFail($id);
        $app->update($request->all());
        return response()->json($app);
    }

    /**
     * 
     */
    public function destroy($id){
        $app = Aplicaciones::findOrFail($id);
        $app->delete();
        return response()->json(null, 204);
    }
}
