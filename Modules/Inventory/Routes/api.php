<?php
use Modules\Inventory\Http\Controllers\Api\InventoriesController;


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
Route::prefix('/inventories')->group(function () {
    Route::get('/', [InventoriesController::class, 'index']);
    Route::get('/{id}', [InventoriesController::class, 'show']);
    Route::post('/', [InventoriesController::class, 'store']);
    Route::put('/{id}', [InventoriesController::class, 'update']);
    Route::delete('/{id}', [InventoriesController::class, 'destroy']);
});
