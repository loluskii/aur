
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsletterController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/overview/router', function () {
    return view('admin.auth.login');
})->name('login.view');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/block/{id}',[UserController::class,'blockAUser'])->name('users.blockuser');
    Route::get('users/blocked',[UserController::class,'blockedUsers'])->name('users.blocked');
    Route::get('users/unblock/{id}',[UserController::class,'unblockAUser'])->name('users.unblock');
    Route::get('users/{id}',[UserController::class,'show'])->name('users.show');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}',[OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/update/{id}',[OrderController::class,'update'])->name('orders.update');

    Route::post('products/create', [ProductController::class, 'store'])->name('product.store');
    Route::post('products/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::get('product/delete/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');
    Route::get('products/category',[ProductController::class, 'makeCategory'])->name('category.index');
    Route::post('category/create',[ProductController::class, 'addCategory'])->name('category.add');
    Route::get('category/view/{id}',[ProductController::class, 'viewCategory'])->name('category.show');
    Route::post('products/category/update/{id}', [ProductController::class, 'updateCategory'])->name('category.update');
    Route::get('category/delete/{id}',[ProductController::class,'deleteCategory'])->name('category.delete');
    
    Route::get('newsletter/all', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::get('newsletter/create', [NewsletterController::class, 'create'])->name('newsletter.create');


});
