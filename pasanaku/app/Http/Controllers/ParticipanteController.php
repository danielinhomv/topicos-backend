<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{

    function hasRole($id, $rol_name)
    {
        try {
            $participante = Participante::find($id);
            if ($participante->hasRole($rol_name)) {
                return response()->json(['mensaje' => 'esta asignado al rol']);
            };
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function setCuenta($id,$cuenta_id){
     try {
        $participante=Participante::find($id);
        $participante->setCuenta($cuenta_id);
        return response()->json(['mensaje'=>'registro de cuenta exitosa']);
     } catch (\Throwable $th) {
        throw $th;
     }
    }
}
