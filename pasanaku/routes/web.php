<?php

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
Route::get('contactanos',function(){
    
    $juego=new JuegoController();
    $filePath=$juego->qrcode();
    $response=Mail::to('montanovargasdaniel39@gmail.com')->send(new CorreoMailable($filePath));
    dump($response);
    
})->name('contactanos');

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
    
});
