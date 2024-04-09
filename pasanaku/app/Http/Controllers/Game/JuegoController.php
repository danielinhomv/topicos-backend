<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Cuenta;
use App\Models\Juego;
use App\Models\Participante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class JuegoController extends Controller
{
    //
    public function index()
    {
        $user = User::find(Auth::id());

        // Obtener los juegos asociados al usuario con el rol de participación
        $juegos = $user->getJuegos()->addSelect([
            'rol' => Participante::select('rol')
                ->whereColumn('juego_id', 'juegos.id')
                ->where('user_id', Auth::id())
                ->limit(1)
        ])->get();


        return Inertia::render('Game/Index', ['juegos' => $juegos]);
    }

    public function create(Request $request)
    {
        Juego::crear($request);
    }
    static function qrcode($nombreJuego, $nro_participantes, $monto, $moneda)
    {
        $info = "Nombre del Juego: $nombreJuego\n";
        $info .= "limite de Participantes: $nro_participantes\n";
        $info .= "Monto: $monto $moneda\n";
        $url = 'http://127.0.0.1:8000/';
        $content = $info . "\n" . $url;
        $qrCode = QrCode::size(150)->generate($content);
        return $qrCode;
    }


    public function home($id)
    {
        $juego = Juego::find($id);
        $cuentas = Cuenta::where('id', Auth::id())->get();
        $participantes = User::join('participantes', 'users.id', '=', 'participantes.user_id')
            ->where('participantes.juego_id', $id)
            ->get();
        return Inertia::render('Game/Home', [
            'juego' => $juego,
            'cuentas' => $cuentas,
            'participantes' => $participantes
        ]);
    }
}
