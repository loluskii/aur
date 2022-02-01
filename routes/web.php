<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
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

Route::get('/',[PagesController::class, 'index'])->name('home');

Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register-user');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::group(['prefix' => 'shop'], function () {
    Route::get('/',[ProductController::class, 'index'])->name('shop');
    Route::get('{tag}', [ProductController::class, 'show'])->name('product.show');

});

Route::middleware(['auth'])->group(function () {
    Route::get('add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/step=contact_information', [CartController::class,'contactInformation'])->name('checkout.step_one');
    Route::get('/checkout/previous_step=contact_information&step=shipping', [CartController::class,'shipping'])->name('checkout.step_two.index');
    Route::post('/checkout/previous_step=contact_information&step=shipping', [CartController::class,'postShipping'])->name('checkout.step_two');
    Route::get('/checkout/previous_step=shipping&step=payment', [CartController::class,'showPayment'])->name('checkout.step_three.index');
    Route::post('/checkout/step=payment', [PaymentController::class,'handlePayment'])->name('payment.create');
    Route::get('/checkout/success', [PaymentController::class, 'paymentSuccess'])->name('payment.succeess');
    Route::get('/checkout/failed', [PaymentController::class, 'paymentFailure'])->name('payment.failure');

});



