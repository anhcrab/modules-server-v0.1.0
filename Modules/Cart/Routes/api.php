<?php
use Modules\Cart\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/carts')->group(function () {
    Route::get('/{device}', [CartController::class, 'show']);
    Route::post('/', [CartController::class, 'store']);
    //    Route::delete('/{device}', [CartController::class, 'destroy']);
    Route::post('/add', [CartController::class, 'addProducts']);
    Route::post('/remove', [CartController::class, 'removeProducts']);
    Route::post('/clear', [CartController::class, 'clearProducts']);
});
