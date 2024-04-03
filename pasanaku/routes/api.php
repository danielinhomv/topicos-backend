<?php

use App\Http\Controllers\Game\JuegoController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\CuentaController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sactum/token', [AuthController::class, 'generateToken']);

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return "tokens eliminado";
});


