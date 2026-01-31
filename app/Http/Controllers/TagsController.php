<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    protected int $max_paginate = 10;

    /**
     * Mostrar todos los tags
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todos los tags
     */
    public function index(){
        $tags = Tags::paginate($this->max_paginate);
        return response()->json($tags);
    }

    /**
     * Mostrar un tag por ID
     * 
     * 
     */
    public function show($id){
        $tag = Tags::findOrFail($id);
        return response()->json($tag);
    }

    /**
     * Crear un tag
     */
    public function store(Request $request){
        $tag = Tags::create($request->all());
        return response()->json($tag);
    }

    /**
     * 
     */
    public function update(Request $request, $id){
        $tag = Tags::findOrFail($id);
        $tag->update($request->all());
        return response()->json($tag);
    }

    /**
     * 
     */
    public function destroy($id){
        $tag = Tags::findOrFail($id);
        $tag->delete();
        return response()->json(null, 204);
    }
}
