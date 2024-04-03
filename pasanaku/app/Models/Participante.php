<?php

namespace App\Models;

use App\Providers\RespuestaJson;
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


    private function validarRol()
    {
        if (!$this->hasRole('lider')) {
            return RespuestaJson::respuesta('no estas autorizado para realizar esta accion');
        }
    }

    
    function setCuenta($cuenta_id){
        if(!$this->cuenta_id){
           $cuenta = Cuenta::find($cuenta_id);
          $cuenta ? $this->cuenta_id=$cuenta->id : null; 
          $this->save();
        }
    }
}
