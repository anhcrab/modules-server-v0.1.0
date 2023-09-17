<?php
use Modules\Order\Http\Controllers\Api\BanksController;
use Modules\Order\Http\Controllers\Api\OrderController;
use Modules\Order\Http\Controllers\Api\PaymentController;
use Modules\Order\Http\Controllers\Api\ShippingController;
use Modules\Order\Http\Controllers\Api\StoresController;

/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/{uuid}', [OrderController::class, 'showByUuid']);
    Route::get('/cancel/{id}', [OrderController::class, 'cancelById']);
    Route::put('/{id}', [OrderController::class, 'updateStatus']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Banks Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/banks')->group(function () {
    Route::get('/', [BanksController::class, 'index']);
    Route::post('/', [BanksController::class, 'store']);
    Route::get('/{id}', [BanksController::class, 'show']);
    Route::put('/{id}', [BanksController::class, 'update']);
    Route::delete('/{id}', [BanksController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Stores Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/stores')->group(function () {
    Route::get('/', [StoresController::class, 'index']);
    Route::post('/', [StoresController::class, 'store']);
    Route::get('/{id}', [StoresController::class, 'show']);
    Route::put('/{id}', [StoresController::class, 'update']);
    Route::delete('/{id}', [StoresController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
    Route::post('/', [PaymentController::class, 'store']);
    Route::get('/{id}', [PaymentController::class, 'show']);
    Route::put('/{id}', [PaymentController::class, 'update']);
    Route::delete('/{id}', [PaymentController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Shipping Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/shipping')->group(function () {
    Route::get('/', [ShippingController::class, 'index']);
    Route::post('/', [ShippingController::class, 'store']);
    Route::get('/{id}', [ShippingController::class, 'show']);
    Route::put('/{id}', [ShippingController::class, 'update']);
    Route::delete('/{id}', [ShippingController::class, 'destroy']);
});
