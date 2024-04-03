<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RespuestaJson;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        try {              
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
            $user=User::create($request->all());
            return RespuestaJson::respuestaGet('registro exitoso',$user);        
        } catch (\Throwable $th) {
            return RespuestaJson::respuestaExcepcion($th);
        }
    }
}
