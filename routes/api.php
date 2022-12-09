<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// group routing middleware
Route::middleware('auth:api')->group(function () {
    Route::resource('/category', CategoryController::class);
    Route::post('product/{id}', [ProductController::class, 'update']);
});

// sing middleware apply gareko
Route::resource('/product', ProductController::class)->middleware('auth:api');
