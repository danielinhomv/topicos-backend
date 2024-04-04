<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Mail\CorreoMailable;
use App\Models\Invitacion;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class InvitacionController extends Controller
{
    //
    public function index(String $juego_id)
    {
        $juego=Juego::find($juego_id);
        return Inertia::render('Game/Invitacion',['juego'=>$juego]);
    }
    public function realizarInvitaciones(String $juego_id, String $correos)
    {

            $juego=Juego::find($juego_id);
            $nombre = $juego->nombre;
            $nro_participantes = $juego->nro_participantes;
            $monto = $juego->monto;
            $moneda = $juego->moneda;
            $lista_correos = explode(',', $correos);
            $qr = JuegoController::qrcode($nombre, $nro_participantes, $monto, $moneda);
            foreach ($lista_correos as $correo) {
                Mail::to($correo)->send(new CorreoMailable($qr));
                Invitacion::create([
                    'participante_id' => Auth::id(),
                    'juego_id' => $juego->id
                ]);
            }
            return Inertia::render('Game/Invitacion',['juego'=>$juego]);
        }
}
