<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use App\Models\User;
use Illuminate\Http\Request;

class CuentaController extends Controller
{

    function getCuentas($user_id){
        try {
            $cuentas = Cuenta::where('user_id', $user_id)->get();
            return response()->json($cuentas);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nro_cuenta' => 'required|unique:cuentas,nro_cuenta',
            'entidad' => 'required'
        ]);
        try {
            Cuenta::create($request->All());
            return response()->json(['mensaje' => 'registro exitoso']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function update(Request $request)
    {
        $request->validate([
            'nro_cuenta' => 'required|unique:cuentas,nro_cuenta',
            'entidad' => 'required'
        ]);
        try {
            $cuenta = Cuenta::find($request->id);
            $cuenta->save($request->all());
            return response()->json(['mensaje' => 'actualizacion exitoso']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function delete($id)
    {
        try {
            $cuenta = Cuenta::find($id);
            $cuenta->delete();
            return response()->json(['mensaje' => 'cuenta eliminada']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
