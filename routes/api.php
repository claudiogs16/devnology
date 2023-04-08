<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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
Route::get('/users', [UserController::class, 'showAllUser']);
Route::get('/users/{id}', [UserController::class, 'showUser']);

// ProductController
Route::get('/products', [ProductController::class, 'showAllProduct']);
Route::get('/products/{supplierID}/{id}', [ProductController::class, 'showProduct']);
