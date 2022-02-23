<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\NewsletterController;

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

// Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register-user');
Route::post('signout', [AuthController::class, 'signOut'])->name('signout');
Route::post('subscribe', [NewsletterController::class, 'storeSubscriber'])->name('subscribe');
Route::get('pages/about-us', [PagesController::class,'aboutUs'])->name('about-us');
Route::get('pages/shipping-and-returns', [PagesController::class,'shippingPolicy'])->name('shipping');
Route::get('pages/contact', [PagesController::class,'contact'])->name('contact');


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
    Route::post('/checkout/step=payment', [PaymentController::class,'stripeHandlePayment'])->name('payment.create');
    Route::get('/checkout/success', [PaymentController::class, 'paymentSuccess'])->name('payment.succeess');
    Route::post('/pay', [PaymentController::class, 'flutterInit'])->name('pay.flutter');
    Route::get('/rave/callback', [PaymentController::class,'flutterwaveCallback'])->name('flutter.callback');
    Route::get('/checkout/failed', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
    Route::get('/account', [HomeController::class, 'index'])->name('account');
    Route::get('/account/add', [HomeController::class, 'addAddress'])->name('account.address.add');
    Route::get('/account/edit', [HomeController::class, 'editAddress'])->name('account.address.edit');
    Route::post('/account/add', [HomeController::class, 'storeAddress'])->name('account.address.store');
    Route::post('/account/update', [HomeController::class, 'updateAddress'])->name('account.address.update');
    Route::get('/account/address/delete/{id}', [HomeController::class, 'deleteAddress'])->name('account.address.delete');
    Route::get('/account/orders/{id}', [HomeController::class, 'getOrderDetails'])->name('account.order.show');

});



