<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Api\AttributesController;
use Modules\Product\Http\Controllers\Api\CategoriesController;
use Modules\Product\Http\Controllers\Api\ProductsController;
use Modules\Product\Http\Controllers\Api\ReviewsController;
use Modules\Product\Http\Controllers\Api\TagsController;
use Modules\Product\Http\Controllers\Api\TypesController;

/*
|--------------------------------------------------------------------------
| Shop Routes
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/get/{id}', [ProductsController::class, 'show']);
Route::get('/products/{slug}', [ProductsController::class, 'showBySlug']);
Route::get('/product-types', [TypesController::class, 'index']);
Route::get('/product-categories', [CategoriesController::class, 'index']);
Route::get('/product-attributes', [AttributesController::class, 'index']);
Route::get('/product-tags', [TagsController::class, 'index']);
Route::get('/product-reviews', [ReviewsController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Reviews Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/reviews')->group(function () {
    Route::get('/', [ReviewsController::class, 'index']);
    Route::post('/', [ReviewsController::class, 'store']);
    Route::get('/{id}', [ReviewsController::class, 'show']);
    Route::put('/{id}', [ReviewsController::class, 'update']);
    Route::delete('/{id}', [ReviewsController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Types Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/types')->group(function () {
        Route::get('/', [TypesController::class, 'index']);
        Route::post('/', [TypesController::class, 'store']);
        Route::get('/{id}', [Typesontroller::class, 'show']);
        Route::put('/{id}', [TypesController::class, 'update']);
        Route::delete('/{id}', [TypesController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    |   Categories Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index']);
        Route::post('/', [CategoriesController::class, 'store']);
        Route::get('/{id}', [CategoriesController::class, 'show']);
        Route::put('/{id}', [CategoriesController::class, 'update']);
        Route::delete('/{id}', [CategoriesController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | Product Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/products')->group(function () {
        Route::post('/', [ProductsController::class, 'store']);
        Route::post('/update/{id}', [ProductsController::class, 'update']);
        // Route::put('/update-stock/{id}', [ProductController::class, 'updateBuying']); //Hàm này sẽ gây ra sự mất đồng nhất về dữ liệu ở cart và stock
        Route::delete('/{id}', [ProductsController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | Attributes Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/attributes')->group(function () {
        Route::get('/', [AttributesController::class, 'index']);
        Route::post('/', [AttributesController::class, 'store']);
        Route::get('/{id}', [AttributesController::class, 'show']);
        Route::put('/{id}', [AttributesController::class, 'update']);
        Route::delete('/{id}', [AttributesController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | Tags Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/tags')->group(function () {
        Route::get('/', [TagsController::class, 'index']);
        Route::post('/', [TagsController::class, 'store']);
        Route::get('/{id}', [TagsController::class, 'show']);
        Route::put('/{id}', [TagsController::class, 'update']);
        Route::delete('/{id}', [TagsController::class, 'destroy']);
    });
});
