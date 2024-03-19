<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            if ($user) {
                return response()->json([
                    'messaje' => 'Credenciales incorrectas',
                    'error' => 'contraseña incorrecta'
                ], 401);
            }
            return response()->json([
                'messaje' => 'Credenciales incorrectas',
                'error' => 'email incorrecto'
            ], 422);
        }
        return $user->createToken($request->device_name)->plainTextToken;
        return $request;
    }
}
