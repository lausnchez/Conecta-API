<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    // CRUD BÁSICO
    //---------------------------------------------------------

    /**
     * Mostrar todos los usuarios
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todos los usuarios en formato JSON
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Mostrar un usuario por su ID
     * 
     * @param int $id ID del usuario
     * @return \Illuminate\Http\JsonResponse Usuario en formato JSON 
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Crear un usuario
     * 
     * @param \Illuminate\Http\Request $request Datos del usuario a registrar
     * @return \Illuminate\Http\JsonResponse Usuario creado en formato JSON
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Actualizar un usuario
     * 
     * @param int $id ID del usuario a editar
     * @param \Illuminate\Http\Request $request Datos nuevos del usuario
     * @return \Illuminate\Http\JsonResponse Usuario después de ser editado en formato JSON
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Borrar un usuario
     * 
     * @param int $id ID del usuario a borrar
     * @return \Illuminate\Http\JsonResponse Respuesta vacía con código 204
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }

    // MÉTODOS ESPECÍFICOS
    //---------------------------------------------------------

    /**
     * Recoge usuarios activos
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios activos
     */
    public function activos(){
        $users = User::activo(true)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios inactivos
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios inactivos
     */
    public function inactivos(){
        $users = User::activo(false)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son empresas
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function empresas(){
        $users = User::empresas(true)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios si no son empresas
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function no_empresas(){
        $users = User::empresas(false)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son familiares
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function familiares(){
        $users = User::familiar(true)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios si no son familiares
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function no_familiares(){
        $users = User::familiar(false)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son Admins
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios por el rol insertado
     */
    public function admins(){
        $users = User::porRol(1)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios sin son Developers
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios por el rol insertado
     */
    public function developers(){
        $users = User::porRol(2)->get();
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son Clientes
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios por el rol insertado
     */
    public function users(){
        $users = User::porRol(3)->get();
        return response()->json($users);
    }

    /**
     * Recoge un usuario buscando por su username
     * 
     * @param string $username Username del usuario
     * @return \Illuminate\Http\JsonResponse Usuario con el username insertado
     */
    public function username($username){
        $user = User::username($username)->first();

        if(!$user){
            return response()->json([
                'error'=> 'Usuario no encontrado',
            ], 404);
        }
        return response()->json($user);
    }
}
