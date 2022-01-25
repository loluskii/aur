<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register-user');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');


Route::get('shop',[ProductController::class, 'index'])->name('shop');
Route::get('shop/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');



