<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    protected int $max_paginate = 10;

    // CRUD BÁSICO
    //---------------------------------------------------------

    /**
     * Mostrar todos los usuarios
     * 
     * @return \Illuminate\Http\JsonResponse Lista de todos los usuarios en formato JSON
     */
    public function index()
    {
        // $users = User::all();
        // $users = User::with('rol')->get();
        $users = User::with('rol')->paginate($this->max_paginate);
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
        $user = User::with('rol')->findOrFail($id);
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

        // Validación de los datos antes de realizar el update
        $data = $request->validate([
            'username' => ['sometimes', 'string', 'max:20'],
            'email' => ['sometimes', 'email', 'unique:users,email,' . $user->id],
            'password' => ['sometimes', 'confirmed', Password::defaults()],
            'fecha_nacimiento' => ['sometimes', 'date'],
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

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
        $users = User::activo(true)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios inactivos
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios inactivos
     */
    public function inactivos(){
        $users = User::activo(false)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son empresas
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function empresas(){
        $users = User::empresas(true)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios si no son empresas
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function no_empresas(){
        $users = User::empresas(false)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son familiares
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function familiares(){
        $users = User::familiar(true)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios si no son familiares
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios que son empresas
     */
    public function no_familiares(){
        $users = User::familiar(false)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son Admins
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios por el rol insertado
     */
    public function admins(){
        $users = User::porRol(1)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios sin son Developers
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios por el rol insertado
     */
    public function developers(){
        $users = User::porRol(2)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge usuarios si son Clientes
     * 
     * @return \Illuminate\Http\JsonResponse Listado de usuarios por el rol insertado
     */
    public function users(){
        $users = User::porRol(3)->with('rol')->paginate($this->max_paginate);
        return response()->json($users);
    }

    /**
     * Recoge un usuario buscando por su username
     * 
     * @param string $username Username del usuario
     * @return \Illuminate\Http\JsonResponse Usuario con el username insertado
     */
    public function username($username){
        // $user = User::username($username)->with('rol')->first();
        $user = User::username($username)->with('rol')->paginate($this->max_paginate);

        if(!$user){
            return response()->json([
                'error'=> 'Usuario no encontrado',
            ], 404);
        }
        return response()->json($user);
    }

    /**
     * Recoge un usuario buscando por su nombre y su apellido
     * 
     * @param string $nombre Nombre del usuario
     * @param string $apellido Apellido(s) del usuario
     * @return \Illuminate\Http\JsonResponse Usuario con nombre y apellidos coincidentes
     */
    public function nombreCompleto($busqueda){
        // $user = User::nombre($nombre)->apellido($apellido)->with('rol')->get();
        $user = User::nombreCompleto($busqueda)->with('rol')->paginate($this->max_paginate);
        return response()->json($user);
    }
}
