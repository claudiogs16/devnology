<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

// TestController
Route::get('/test', [TestController::class, 'show']);
Route::get('/supplier', [TestController::class, 'loadAPISupplier']);

// UserController
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

// ProductController
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{supplierID}/{id}', [ProductController::class, 'show']);

// CartController
Route::get('/carts/{user_id}', [CartController::class, 'index']);
Route::post('/carts/store', [CartController::class, 'store']);
Route::put('/carts/decrement/{id}', [CartController::class, 'decrement']);
Route::delete('/carts/{id}', [CartController::class, 'destroy']);
Route::delete('/carts/clear/{user_id}', [CartController::class, 'clear']);

// OrderController
Route::get('/orders/{user_id}', [OrderController::class, 'index']);
Route::post('/orders/{user_id}', [OrderController::class, 'store']);


