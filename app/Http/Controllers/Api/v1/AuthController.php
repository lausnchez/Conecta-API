<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\Controller;
class AuthController extends Controller{
    
    /**
    * Registra un nuevo usuario.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function registro(Request $request) {
        //Validamos los campos que esperamos recibir
        try {
            // Validamos los campos que esperamos recibir
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
        } catch (ValidationException $e) {
            // Capturamos la excepción de validación y devolvemos una respuesta JSON
            return response()->json([
                'mensaje' => 'Faltan campos por rellenar o los campos no son válidos',
                'errores' => $e->errors()
            ], 422);
        }
        //Verificamos si el usuario ya está registrado
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['mensaje' => 'El usuario ya está registrado'], 409);
        }
        //Creamos el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        //Devolvemos una respuesta JSON indicando que el usuario fue registrado exitosamente
        return response()->json(['mensaje' => 'Usuario registrado exitosamente'], 201);
    }
    
    /**
    * Autentica un usuario y devuelve un token de acceso.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function login(Request $request){
        //Validamos los campos que esperamos recibir
        try {
            // Validamos los campos que esperamos recibir
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            // Capturamos la excepción de validación y devolvemos una respuesta JSON
            return response()->json([
                'mensaje' => 'Faltan campos por rellenar o los campos no son válidos',
                'errores' => $e->errors()
                ], 422);
        }

        //Intentamos autenticar al usuario
        $user = User::where('email', $request->email)->first();
        //Verificamos si las credenciales son correctas
        if (!$user || !Hash::check($request->password, $user->password)) {
            
            return response()->json(['mensaje' => 'Las credenciales proporcionadas son incorrectas'], 401);
        }

        // Generamos un token de acceso para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;
        // Devolvemos una respuesta JSON con el token de acceso
        return response()->json(['token' => $token, 'mensaje' => 'Inicio de sesión exitoso'], 200);
    }

    public function user(Request $request){return $request->user();}
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada'], 200);
    }
}