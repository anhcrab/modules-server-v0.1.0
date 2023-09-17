<?php
use Modules\Payment\Http\Controllers\Api\TransactionsController;

/*
|--------------------------------------------------------------------------
| Transaction Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/transaction')->group(function () {
    Route::get('/', [TransactionsController::class, 'index']);
    Route::post('/', [TransactionsController::class, 'store']);
    Route::get('/{id}', [TransactionsController::class, 'show']);
    Route::put('/{id}', [TransactionsController::class, 'update']);
    Route::delete('/{id}', [TransactionsController::class, 'destroy']);
});
