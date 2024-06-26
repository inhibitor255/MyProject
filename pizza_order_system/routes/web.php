<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;
use App\Models\Product;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin_auth'])->group(function () {
    // login, register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('auth#dashboard');

    // Admin
    Route::middleware('admin_auth')->group(function () {
        // admin account
        Route::prefix('admins')->group(function () {
            // admin list
            Route::get('list/page', [AdminController::class, 'listPage'])->name('admin#listPage');
            Route::post('list/page', [AdminController::class, 'listPage'])->name('admin#listPage');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('change/role/page/{id}', [AdminController::class, 'changeRolePage'])->name('admin#changeRolePage');
            Route::post('change/role/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::get('ajax/role/change', [AdminController::class, 'ajaxChangeRole'])->name('admin#ajaxChangeRole');

            // profile
            Route::get('/account/detail/page', [AdminController::class, 'detailPage'])->name('admin#detailPage');
            Route::get('/account/edit/page', [AdminController::class, 'editPage'])->name('admin#editPage');
            Route::post('/account/update', [AdminController::class, 'update'])->name('admin#update');

            // user
            Route::get('user/list/page', [AdminController::class, 'userListPage'])->name('admin#userListPage');
            Route::post('user/list/page', [AdminController::class, 'userListPage'])->name('admin#userListPage');
            Route::get('user/edit/page/{id}', [AdminController::class, 'userEditPage'])->name('admin#userEditPage');
            Route::post('user/edit', [AdminController::class, 'userEdit'])->name('admin#userEdit');


            // password
            Route::get('/password/change/page', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('/password/change', [AdminController::class, 'passwordChange'])->name('admin#passwordChange');

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

            // product
            Route::prefix('products')->group(function () {
                Route::get('list/page', [ProductController::class, 'list'])->name('product#listPage');
                Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
                Route::post('create', [ProductController::class, 'create'])->name('product#create');
                Route::post('list/page', [ProductController::class, 'list'])->name('product#searchData');
                Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
                Route::get('detail/page/{id}', [ProductController::class, 'detailPage'])->name('product#detailPage');
                Route::get('edit/page/{id}', [ProductController::class, 'editPage'])->name('product#editPage');
                Route::post('edit/', [ProductController::class, 'edit'])->name('product#edit');
            });

            // order
            Route::prefix('order')->group(function () {
                Route::get('list/page', [OrderController::class, 'listPage'])->name('order#listPage');
                Route::post('change/status', [OrderController::class, 'changeStatus'])->name('order#changeStatus');
                Route::get('ajax/status/change', [OrderController::class, 'ajaxStatusChange'])->name('order#ajaxStatusChange');
                Route::get('list/info/{orderCode}', [OrderController::class, 'listInfo'])->name('order#listInfo');
            });

            // contact
            Route::prefix('contact')->group(function () {
                Route::get('list/page', [ContactController::class, 'listPage'])->name('contact#listPage');
                Route::get('delete/{id}', [ContactController::class, 'delete'])->name('contact#delete');
            });
        });
    });

    // User
    Route::prefix('users')->middleware('user_auth')->group(function () {
        // home
        Route::get('/home/page', [UserController::class, 'homePage'])->name('user#homePage');
        Route::get('filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('history/page', [UserController::class, 'historyPage'])->name('user#historyPage');

        // profile
        Route::prefix('profile')->group(function () {
            Route::get('change/page', [UserController::class, 'profileChangePage'])->name('user#profileChangePage');
            Route::post('change', [UserController::class, 'profileChange'])->name('user#profileChange');
        });

        // password
        Route::prefix('password')->group(function () {
            Route::get('change/page', [UserController::class, 'passwordChangePage'])->name('user#passwordChangePage');
            Route::post('change', [UserController::class, 'passwordChange'])->name('user#passwordChange');
        });

        // pizza
        Route::prefix('pizzas/')->group(function () {
            Route::get('detail/page/{id}', [UserController::class, 'pizzaDetailPage'])->name('user#pizzaDetailPage');
        });

        // cart
        Route::prefix('cart/')->group(function () {
            Route::get('page/', [CartController::class, 'cartPage'])->name('cart#page');
        });

        // contact
        Route::prefix('contact/')->group(function () {
            Route::get('page/', [ContactController::class, 'page'])->name('contact#page');
            Route::post('submit/form', [ContactController::class, 'submitForm'])->name('contact#submitForm');
        });

        // ajax
        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('add/cart', [AjaxController::class, 'addCart'])->name('ajax#addCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('clear/cart/once', [AjaxController::class, 'clearCartOnce'])->name('ajax#clearCartOnce');
            Route::get('increase/view/count', [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
        });
    });
});

Route::get('webTesting', function () {

    $data =
        ['message' => 'this is web testing message',];
    return response()->json($data, 200,);
});
