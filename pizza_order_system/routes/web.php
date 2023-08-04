<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// login, register
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('auth#dashboard');


    // Admin
    // category
    Route::prefix('categories')->middleware('admin_auth')->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
    });

    // User
    // home
    Route::prefix('users')->middleware('user_auth')->group(function () {
        Route::get('home', function () {
            return view('user.home');
        })->name('user#home');
    });
});

// User
