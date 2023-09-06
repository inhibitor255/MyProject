<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ContactApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/products', ProductApiController::class);
Route::apiResource('/categories', CategoryApiController::class);
Route::apiResource('/contacts', ContactApiController::class);

// RouteController
Route::post('category/delete', [RouteController::class, 'deleteCategory']);
Route::post('category/details', [RouteController::class, 'showCategory']);
Route::post('category/update', [RouteController::class, 'updateCategory']);
