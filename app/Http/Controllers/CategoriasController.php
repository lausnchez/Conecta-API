<?php

namespace App\Http\Controllers;
use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    protected int $max_paginate = 10;

    /**
     * Mostrar todos las categorías
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todas las categorías
     */
    public function index(){
        $categorias = Categorias::paginate($this->max_paginate);
        return response()->json($categorias);
    }

    /**
     * Mostrar una categoría por ID
     * 
     * 
     */
    public function show($id){
        $categoria = Categorias::findOrFail($id);
        return response()->json($categoria);
    }

    /**
     * Crear un categoria
     */
    public function store(Request $request){
        $categoria = Categorias::create($request->all());
        return response()->json($categoria);
    }

    /**
     * 
     */
    public function update(Request $request, $id){
        $categoria = Categorias::findOrFail($id);
        $categoria->update($request->all());
        return response()->json($categoria);
    }

    /**
     * 
     */
    public function destroy($id){
        $categoria = Categorias::findOrFail($id);
        $categoria->delete();
        return response()->json(null, 204);
    }
}
