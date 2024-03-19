<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Juego;
use App\Models\Participante;
use App\Models\Rol;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    private function verificarRolLider($participante)
    {
        if (!$participante->hasRole('lider')) {
            abort(403, 'No estás autorizado para realizar esta acción.');
        }
    }
    function store(Request $request, $user_id)
    {
        $request->validate([
            'nro_participantes' => 'required',
            'moneda' => 'required',
            'monto' => 'required|min:0'
        ]);
        try {
            $juego = Juego::create($request->all());
            $participante = Participante::create([
                'user_id' => $user_id,
                'juego_id' => $juego->id,
            ]);
            $participante->setRol('lider');
            return response()->json(['mensaje' => 'registro exitoso']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function delete($participante_id)
    {
        try {
            $participante = Participante::find($participante_id);
            $this->verificarRolLider($participante);
                $juego = Juego::find($participante->juego_id);
                $juego->delete();
                return response()->json(['mensaje' => 'juego eliminado exitosamente']);           
            return response()->json(['mensaje' => 'no estas autorizado']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function setNroParticipantes($valor,$participante_id)
    {
        try {
            $participante = Participante::find($participante_id);
            $this->verificarRolLider($participante);
            $juego = Juego::find($participante->id);
                if ($juego->estado == 'abierto' && $valor >= $juego->nro_participantes_actual) {
                    $juego->nro_participantes = $valor;
                    $juego->save();
                    return response()->json(['mensaje' => 'actualizacion exitosa']);
                }        
            return response()->json(['mensaje' => 'no estas autorizado']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
