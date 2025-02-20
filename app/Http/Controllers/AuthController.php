<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validar que ambos campos sean requeridos
        $request->validate([
            'numero_documento' => 'required',
            'password' => 'required'
        ]);
    
        $user = User::where('numero_documento', $request->numero_documento)->first();
    
        if (!$user) {
            return response()->json(['message' => 'El documento ingresado no existe.'], 400);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Contraseña incorrecta.'], 401);
        }
    
        // Autenticar al usuario
        Auth::login($user);
    
        // Generar un token de autenticación
        $token = $user->createToken('authToken')->plainTextToken;
    
        return response()->json([
            'message' => 'Inicio de sesión exitoso.',
            'token' => $token,
            'user' => $user
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
