<?php

use App\Http\Controllers\Api\CarritoController;
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

Route::apiResource('carrito', CarritoController::class);
Route::middleware(['auth:api'])->group(function () {
    Route::delete('carrito/confirmarPedido/{idCarrito}', [CarritoController::class, 'confirmarPedido']);
});