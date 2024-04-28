<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ClienteController;


Route::group([], function () {
    Route::get('/api/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/api/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/api/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::put('/api/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/api/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

