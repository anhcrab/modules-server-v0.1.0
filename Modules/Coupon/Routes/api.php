<?php

use Modules\Coupon\Http\Controllers\Api\CouponController;

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

Route::prefix('/coupons')->group(function () {
    Route::get('/', [CouponController::class, 'index']);
    Route::get('/{id}', [CouponController::class, 'showById']);
    Route::get('/check/{slug}', [CouponController::class, 'show']);
    Route::post('/', [CouponController::class, 'store']);
    Route::put('/{id}', [CouponController::class, 'update']);
    Route::delete('/{id}', [CouponController::class, 'destroy']);
});
