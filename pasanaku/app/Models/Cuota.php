<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getParticipantes(){
        return $this->belongsToMany(Participante::class);
    }

    public function getTransacciones(){
        return $this->hasMany(Transaccion::class);
    }

    public function getJuego(){
        return $this->belongsTo(Juego::class);
    }
}
