<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Throwable;

class RespuestaJson
{

    static function respuestaHttp($mensaje, Request $request)
    {
        $datos = $request->all();
        return response()->json([$mensaje => $datos]);
    }
    static function respuestaGet($mensaje, $modelo)
    {
        return response()->json([$mensaje => $modelo]);
    }

    static function respuestaExcepcion(Throwable $th)
    {
        return response()->json(['error' => $th->getMessage()]);
    }
    static function respuesta($mesaje)
    {
        return response()->json(${$mensaje});
    }
}
