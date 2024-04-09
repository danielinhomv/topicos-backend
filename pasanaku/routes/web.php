<?php

use App\Http\Controllers\Game\InvitacionController;
use App\Http\Controllers\Game\JuegoController;
use App\Mail\CorreoMailable;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('juegos/index',[JuegoController::class,'index'])->name('juegos.index');
    Route::post('juegos/create',[JuegoController::class,'create'])->name('juegos.create');
    Route::get('juegos/home/{juego_id}',[JuegoController::class,'home'])->name('juegos.home');
    Route::get('invitaciones/index/{juego_id}',[InvitacionController::class,'index'])->name('invitaciones.index');
    Route::get('invitaciones/realizar/{juego_id}/{correos}/{telefonos}',[InvitacionController::class,'realizarInvitaciones'])->name('invitaciones.realizarInvitaciones');


});
