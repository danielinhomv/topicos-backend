<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;
    protected $guarded=[];

    
    public function getParticipantes(){
        return $this->hasMany(Participante::class);
    }
    
    public function getUser(){
        return $this->belongsTo(User::class);
    }
}
