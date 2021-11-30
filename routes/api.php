<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// GUEST
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/products', [ProductController::class, 'getAll']);

// USER (logged in)
Route::middleware('auth:sanctum')->post('cart/products', [CartController::class, 'saveProduct']);
Route::middleware('auth:sanctum')->delete('cart/products/{product_id}', [CartController::class, 'deleteProduct']);
Route::middleware('auth:sanctum')->get('cart/products', [CartController::class, 'getProducts']);
Route::middleware('auth:sanctum')->post('cart/checkout', [CartController::class, 'checkout']);
Route::post('/auth/logout', [UserController::class, 'logout']);
