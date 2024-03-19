<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{

    use HasFactory;
    protected $guarded = [];

    function getCuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }

    function getCuotasOfertadas()
    {
        return $this->belongsToMany(Cuota::class);
    }

    function getTransaccionesRecibidas()
    {
        return $this->hasMany(Transaccion::class, 'recibe_participante_id');
    }

    function getTransaccionesRealizadas()
    {
        return $this->hasMany(Transaccion::class, 'realiza_participante_id');
    }

    function getInvitaciones()
    {
        return $this->hasMany(Invitacion::class);
    }

    function hasRole($name)
    {
        if ($this->rol_id) {
            $rol = Rol::find($this->rol_id);
            return $rol->name == $name;
        }
        return false;
    }

    function setRol($name)
    {
        $rol = Rol::findByName($name);
        if ($rol) {
            $this->rol_id = $rol->id;
            $this->save();
            return response()->json(['mensaje'=>'rol asignado']);
        }
        return response()->json(['mensaje'=>'rol no asignado']);

    }
    function setCuenta($cuenta_id){
        if(!$this->cuenta_id){
           $cuenta = Cuenta::find($cuenta_id);
          $cuenta ? $this->cuenta_id=$cuenta->id : null; 
          $this->save();
        }
    }
}
