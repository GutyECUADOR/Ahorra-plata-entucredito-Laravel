<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DiasInversionController;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\TipoInversionController;
use App\Http\Controllers\FileController;
use App\Mail\SoporteUsuarioMaileable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});

Route::middleware(['auth','role'])->group(function () {
    Route::get('/pagos/{user}', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('/pagos/{user}', [PagoController::class, 'store'])->name('pagos.update');
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users-list');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [CreditoController::class, 'index'])->name('dashboard');
    Route::resource('creditos', CreditoController::class);

    Route::post('/analisis/{credito}', [AnalisisController::class, 'index'])->name('analisis.index');

    Route::resource('tipos-inversion', TipoInversionController::class);
    Route::resource('dias-inversion', DiasInversionController::class);
    Route::post('/uploadfile',[FileController::class, 'store'])->name('uploadFile');
});

require __DIR__.'/auth.php';
