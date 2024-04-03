<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    //web
    static function crear(Request $request){
        $request->validate([
           'nro_participantes'=>'required|numeric|min:2',
           'monto'=>'required|numeric|min:1',
           'moneda'=>'required',
           'nombre'=>'required'
        ]);
        $juego=Juego::create([
            'nombre'=>$request->nombre,
            'nro_participantes'=>$request->nro_participantes,
            'monto'=>$request->monto,
            'moneda'=>$request->moneda
        ]);
        Participante::create([
            'juego_id'=>$juego->id,
            'user_id'=>Auth::id(),
            'rol'=>'lider'
        ]);
        return redirect()->route('juegos.index');
    }
    //movil
    public function actualizar(Request $request){

    }
    public function eliminar($juego_id){

    }


}
