<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getJuego(){
        return $this->belongsTo(Juego::class);
    }

    public function getParticipante(){
        return $this->belongsTo(Participante::class);
    }
}
