<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DiasInversionController;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\WalletController;
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

Route::get('/link', function () {        
    $target = "/home/qex8lzddwa48/clubalarab/storage/app/public"; // Carpeta privada
    $shortcut = "/home/qex8lzddwa48/public_html/clubalarab.com/storage"; // Carpeta publica
   
    symlink($target, $shortcut);
 });

Route::get('/sendEmail', function () {
    return view('mail/sendEmail');
});

Route::post('/sendEmail', function (Request $request) {
    $correo = new SoporteUsuarioMaileable($request->all());
    Mail::to(env('MAIL_TO_ADDRESS'))->send($correo);
    return redirect('/sendEmail')->with('status', 'Solicitud Enviada con éxito!');
})->name('solicitudSoporte');

Route::get('/inversions/{inversion}', [InversionController::class, 'edit'])->middleware(['auth'])->name('inversions.edit');
Route::put('/inversions/{inversion}', [InversionController::class, 'update'])->middleware(['auth'])->name('inversions.update');


Route::middleware(['auth','role'])->group(function () {
    Route::get('/pagos/{user}', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('/pagos/{user}', [PagoController::class, 'store'])->name('pagos.update');
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users-list');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [InversionController::class, 'index'])->name('dashboard');
    Route::resource('tipos-inversion', TipoInversionController::class);
    Route::resource('dias-inversion', DiasInversionController::class);
    Route::post('/uploadfile',[FileController::class, 'store'])->name('uploadFile');
    Route::post('/uploadWalletUSDT',[WalletController::class, 'update_wallet_USDT'])->name('uploadWalletUSDT');
    Route::post('/uploadWalletALARAB',[WalletController::class, 'update_wallet_ALARAB'])->name('uploadWalletALARAB');
});

require __DIR__.'/auth.php';
