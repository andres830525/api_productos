<?php

// Include necessary namespaces
namespace App\Http\Controllers;

use Illuminate\Http\Request; // For handling HTTP requests
use Illuminate\Support\Facades\Auth; // For handling authentication
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User; // User model

// Define AuthController class which extends Controller
class AuthController extends Controller
{

//Funcion para manejar el proceso de regisreo en la Api
public function register(Request $request)
{

//Se validan los campos que llegan por el request
     $request->validate([
    'name' => 'required|string|max:255', // Name must be a string, not exceed 255 characters and it is required
    'email' => 'required|string|email|max:255|unique:users', // Email must be a string, a valid email, not exceed 255 characters, it is required and it must be unique in the users table
    'password' => 'required|string|min:6', // Password must be a string, at least 6 characters and it is required
]); 

// Se crea el nuevo usuario
$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => bcrypt($request->password), // Se encripta el password
]);


//Retorna los datos del usuario como un JSON con el codigo 201 (created) HTTP status code
return response()->json(['user' => $user], 201);
}

// Funcion para manejar el login de el usuario
public function login(Request $request)
{
// Se validan los campos que vinen de el request
$request->validate([
'email' => 'required|string|email', // El campo email debe ser de tipo string, email valido y es requerido
'password' => 'required|string',   // El password debe ser un string  y es requerido
]);

if (!Auth::attempt($request->only('email', 'password'))) {

//Si las credenciales son invalidas se retorna un mensaje con el codigo de error  401 (Unauthorized) HTTP status code
return response()->json(['message' => 'Invalid login details'], 401);
}


// Si las credenciales son validas se obtiene al usario autenticado

$user = $request->user();

//Se crea un nuevo token para este usuario
$token = $user->createToken('authToken')->plainTextToken;

// Se retorna los datos del usuario y el token como JSON
return response()->json(['user' => $user, 'token' => $token, 'Success'=>'true', 'Message'=> "Successful login",'iUserId'=>$user->id]);
}

// Funcion para manejar el logout 
public function logout(Request $request)
{
  // Se borran todos los tokens para el usuario autenticado
  $request->user()->tokens()->delete();


   //S retorna un mensaje en JSON
   return response()->json(['message' => 'Logged out']);
}
}