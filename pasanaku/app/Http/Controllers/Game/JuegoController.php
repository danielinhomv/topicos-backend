<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
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
    public function qrcode()
    {
        $qrCode = QrCode::size(150)->generate('https://github.com/danielinhomv');
        return $qrCode;
    }
}
