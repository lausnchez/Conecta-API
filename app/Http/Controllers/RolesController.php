<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    // CRUD BÁSICO
    //---------------------------------------------------------

    /**
     * Recoger todos los roles
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todos los roles en formato JSON
     */
    public function index(){
        $roles = Roles::all();
        return response()->json($roles);
    }

    /**
     * Recoge un rol por ID
     * 
     * @param int $id ID del rol a buscar
     * @return \Illuminate\Http\JsonResponse Rol encontrado en formato JSON
     */
    public function show($id){
        $rol = Roles::findOrFail($id);
        return response()->json($rol);
    }

    /**
     * Actualizar un rol
     * 
     * @param \Illuminate\Http\Request $request Datos del usuario a registrar
     * @return \Illuminate\Http\JsonResponse Usuario creado en formato JSON
     */
    public function store(Request $request){
        $rol = Roles::create($request->all());
        return response()->json($rol, 201);
    }

    /**
     * Actualizar un rol
     * @param int $id ID del rol a editar
     * @param Request $request Nuevos datos del rol
     * @return \Illuminate\Http\JsonResponse Rol después de ser editado
     */
    public function update(Request $request, $id){
        $rol = Roles::findOrFail($id);

        $data = $request->validate([
            'nombre'=>['required', 'max:255'],
        ]);

        $rol->update($request->all());
        return response()->json($rol);
    }

    /**
     * Borrar un rol
     * 
     * @param int $id ID del rol a borrar
     * @return \Illuminate\Http\JsonResponse Respuesta vacía con el código 204
     */
    public function destroy($id){
        $rol = Roles::findOrFail($id);
        $rol->delete();
        return response()->json(null, 204);
    }

    // MÉTODOS ESPECÍFICOS
    //---------------------------------------------------------

    /**
     * Recoge un rol buscándo por su nombre
     * 
     * @param string $nombreRol Nombre del rol
     * @return \Illuminate\Http\JsonResponse Rol con el nombre
     */
    public function nombre($nombreRol){
        $rol = Roles::nombre($nombreRol)->get();
        return response()->json($rol); 
    }
}
