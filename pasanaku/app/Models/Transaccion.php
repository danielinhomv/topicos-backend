<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getParticipanteEmisor(){
        return $this->belongsTo(Participante::class,'realiza_participante_id');
    }

    public function getParticipanteReceptor(){
        return $this->belongsTo(Participante::class,'recibe_participante_id');
    }
    
    public function getCuota(){
        return $this->belongsTo(Cuota::class);
    }
    
}
