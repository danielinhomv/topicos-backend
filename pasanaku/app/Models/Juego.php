<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getParticipantes(){
        return $this->belongsToMany(User::class);
    }
    
    public function  getCuotas(){
        return $this->hasMany(Cuota::class);
    }
}
