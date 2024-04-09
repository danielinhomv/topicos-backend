<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Mail\CorreoMailable;
use App\Models\Invitacion;
use App\Models\Juego;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;
use Twilio\Rest\Client;

class InvitacionController extends Controller
{
    //
    public function index(String $juego_id)
    {
        $juego = Juego::find($juego_id);
        return Inertia::render('Game/Invitacion', ['juego' => $juego]);
    }
    public function realizarInvitaciones(String $juego_id, String $correos, String $telefonos)
    {
        try {
            $juego = Juego::find($juego_id);
            $nombre = $juego->nombre;
            $nro_participantes = $juego->nro_participantes;
            $monto = $juego->monto;
            $moneda = $juego->moneda;
            $lista_correos = explode(',', $correos);
            $lista_numeros = explode(',', $telefonos);
            // dd($lista_correos,$lista_numeros);
            $qr = JuegoController::qrcode($nombre, $nro_participantes, $monto, $moneda);
            $this->sendEmailAndWhatsapp($lista_correos, $qr, $juego, $lista_numeros);
            dd('las invitaciones fueron enviadas exitosamente');
        } catch (\Throwable $th) {
            dd('error : ' . $th);
        }
    }
    private function sendMessage($number)
    {

        $sid = config('app.twilio_account_sid');
        $token = config('app.twilio_auth_token');
        $twilio = new Client($sid, $token);
        // Envía el mensaje de WhatsApp con la imagen del código QR como archivo adjunto
         $twilio->messages
               ->create("whatsapp:$number",
                                  array(
                                      "from" => "whatsapp:+14155238886",
                                      "body" => "hola te invito a unirte a mi juego de pasanaku",
                                      //"mediaUrl" =>"https://ibb.co/wB0NSG3"
                                  )
                        );
    }
    


    private function sendEmailAndWhatsapp($correos, $qr, $juego, $telefonos)
    {

        foreach ($correos as $correo) {
            Mail::to($correo)->send(new CorreoMailable($qr));
            Invitacion::create([
                'participante_id' => Auth::id(),
                'juego_id' => $juego->id
            ]);
        }
        foreach ($telefonos as $number) {
            $this->sendMessage($number, $qr);
        }
    }
}
