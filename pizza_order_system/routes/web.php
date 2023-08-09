<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// login, register
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('auth#dashboard');

    // Admin
    Route::middleware('admin_auth')->group(function () {
        // category
        Route::prefix('categories')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::post('list', [CategoryController::class, 'list'])->name('category#search');
            Route::get('editPage/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
            Route::post('edit/', [CategoryController::class, 'edit'])->name('category#edit');
        });

        // admin account
        Route::prefix('admin')->group(function () {
            // password
            Route::get('/password/change/page', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('change/password', [AdminController::class, 'passwordChange'])->name('admin#passwordChange');

            // profile
            Route::get('/account/detail', [AdminController::class, 'detail'])->name('admin#detail');
        });
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
