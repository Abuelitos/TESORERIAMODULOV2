<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BancoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
            

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


// RUTAS CLIENTES
Route::group(['prefix' => 'clientes', 'middleware' => 'auth'], function () {
    Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/crear', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/{cliente}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

// Rutas para BancoController
Route::group(['prefix' => 'bancos', 'middleware' => 'auth'], function () {
    Route::get('/', [BancoController::class, 'index'])->name('bancos.index');
    Route::get('/crear', [BancoController::class, 'create'])->name('bancos.create');
    Route::post('/', [BancoController::class, 'store'])->name('bancos.store');
    Route::get('/{banco}', [BancoController::class, 'show'])->name('bancos.show');
    Route::get('/{banco}/editar', [BancoController::class, 'edit'])->name('bancos.edit');
    Route::put('/{banco}', [BancoController::class, 'update'])->name('bancos.update');
    Route::delete('/{banco}', [BancoController::class, 'destroy'])->name('bancos.destroy');

    // Rutas adicionales
    Route::get('/transferencias', [BancoController::class, 'transferencias'])->name('bancos.transferencias');
    Route::get('/remesaspagos', [BancoController::class, 'remesaspagos'])->name('bancos.remesaspagos');
    Route::get('/remesascobros', [BancoController::class, 'remesascobros'])->name('bancos.remesascobros');
    Route::get('/notascargos', [BancoController::class, 'notascargos'])->name('bancos.notascargos');
    Route::get('/notasabonos', [BancoController::class, 'notasabonos'])->name('bancos.notasabonos');
    Route::get('/cheques', [BancoController::class, 'cheques'])->name('bancos.cheques');
    Route::get('/cuentaBanco', [BancoController::class, 'cuentaBanco'])->name('bancos.cuentaBanco');
});
