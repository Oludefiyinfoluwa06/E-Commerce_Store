<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'all_products']);
Route::get('/products', [ProductController::class, 'admin_products']);

// User login and signup logic
Route::get('/user_login', function () {
    if (session()->has('user_email')) {
        return redirect('/');
    }

    return view('user_login');
});

Route::get('/user_register', function () {
    if (session()->has('user_email')) {
        return redirect('/');
    }

    return view('user_register');
});

Route::post('/user_register', [UserController::class, 'user_register']);
Route::post('/user_login', [UserController::class, 'user_login']);
Route::get('/user_logout', [UserController::class, 'user_logout'])->name('user_logout');


// Admin Login and Signup logic
Route::get('/admin_login', function () {
    if (session()->has('admin_email')) {
        return redirect('/products');
    }
    
    return view('admin_login');
});

Route::get('/admin_register', function () {
    if (session()->has('admin_email')) {
        return redirect('/products');
    }

    return view('admin_register');
});

Route::post('/admin_register', [UserController::class, 'admin_register']);
Route::post('/admin_login', [UserController::class, 'admin_login']);
Route::get('/admin_logout', [UserController::class, 'admin_logout'])->name('admin_logout');

Route::get('/add_product', function () {
    if (!session()->has('admin_email')) {
        return redirect('/admin_login');
    }

    return view('add_product');
});

Route::post('/add_product', [ProductController::class, 'add_product']);
Route::get('/user_view_product/{productId}', [ProductController::class, 'view_product']);
Route::get('/admin_view_product/{productId}', [ProductController::class, 'admin_view_product']);
Route::get('/edit_product/{productId}', [ProductController::class, 'edit_product_page']);
Route::patch('/edit_product/{productId}', [ProductController::class, 'edit_product']);
Route::delete('/delete_product/{productId}', [ProductController::class, 'delete_product'])->name('delete');

Route::get('/cart', [CartController::class, 'cart']);
Route::post('/user_view_product/{productId}', [CartController::class, 'add_to_cart']);
Route::delete('/delete_cart_product/{cartProductId}', [CartController::class, 'delete_cart_product'])->name('delete_cart_product');

Route::post('/cart', [CheckoutsController::class, 'checkout'])->name('checkout');
Route::get('/user_orders', [CheckoutsController::class, 'view_checkouts']);
Route::get('/orders', [CheckoutsController::class, 'admin_view_checkouts']);