<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ContactApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\RouteController;
use Dotenv\Store\File\Reader;
use GuzzleHttp\Promise\Create;
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


//For Category
    // {Create
    // http://127.0.0.1:8000/api/categories with Post method ( need name wants to create);

    // Read
    // http://127.0.0.1:8000/api/categories/ with Get method

    // Read Detail
    // http://127.0.0.1:8000/api/categories/{id} need (id)

    // Update
    // http://127.0.0.1:8000/api/category/update with Post method need(id, name wants to update)

    // Delete
    // http://127.0.0.1:8000/api/category/delete with Post method need (id wants to delete)}

//For Product
    // Read
    // http://127.0.0.1:8000/api/products with Get method

// Contact
    // Create
    // http://127.0.0.1:8000/api/contacts with Post method (need name, email, message want to create)

    // Read
    // http://127.0.0.1:8000/api/contacts with Get method
