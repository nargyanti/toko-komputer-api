<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductAssetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('category/sort_by_product_amount', [CategoryController::class, 'sortByProductAmountDescending']);
    Route::apiResource('/category', CategoryController::class);
    Route::get('product/sort_by_price', [ProductController::class, 'sortByPriceDescending']);
    Route::apiResource('/product', ProductController::class);
    Route::apiResource('/product_asset', ProductAssetController::class);
});
