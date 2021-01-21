<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Customer\CustomerSettingsController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\Seller\SellerRegisterController;
use App\Http\Controllers\Seller\SellerSettingsController;
use App\Http\Controllers\Seller\SellerProductsController;
use App\Http\Controllers\Seller\SellerOrdersController;
use App\Http\Controllers\Seller\SellerPublicController;
use App\Http\Controllers\Customer\CustomerCartController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use App\Models\Seller;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;

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

Route::prefix('/seller')->group(function () {
    Route::get('/register', [SellerRegisterController::class, 'create'])
        ->name('seller.register');
    Route::post('/register', [SellerRegisterController::class, 'store']);

    Route::get('/settings', [SellerSettingsController::class, 'create'])
        ->name('seller.settings');
    Route::post('/settings', [SellerSettingsController::class, 'store']);

    Route::get('/products/', [SellerProductsController::class, 'create'])
        ->name('seller.products');

    Route::post('/product/delete/', [SellerProductsController::class, 'delete'])
        ->name('seller.product.delete');
    Route::post('/product/edit', [SellerProductsController::class, 'edit'])
        ->name('seller.product.edit');
    Route::post('/product/add', [SellerProductsController::class, 'add'])
        ->name('seller.product.add');

    Route::get('/orders', [SellerOrdersController::class, 'create'])
        ->name('seller.orders');
    Route::get('/order/{id}', [SellerOrdersController::class, 'show'])
        ->name('seller.order.id');
    Route::post('/order/update', [SellerOrdersController::class, 'update'])
        ->name('seller.order.update');

    Route::get('/{id}', [SellerPublicController::class, 'create'])
        ->name('seller.id')
        ->whereNumber('id');
});

Route::prefix('/customer')->group(function () {
    Route::get('/settings', [CustomerSettingsController::class, 'create'])
        ->name('customer.settings');
    Route::post('/settings', [CustomerSettingsController::class, 'store']);

    Route::get('/cart', [CustomerCartController::class, 'create'])
        ->name('customer.cart');
    Route::post('/cart', [CustomerCartController::class, 'store']);

    Route::get('/cart/details', [CustomerCartController::class, 'customerDetails'])
        ->name('customer.cart.details');
    Route::post('/cart/buy', [CustomerCartController::class, 'buy'])
        ->name('customer.cart.buy');
    Route::post('/cart/delete-product', [CustomerCartController::class, 'deleteProduct'])
        ->name('customer.cart.delete-product');

    Route::get('/orders', [CustomerOrderController::class, 'create'])
        ->name('orders');
    Route::get('/order/{id}', [CustomerOrderController::class, 'create'])
        ->name('customer.order.id');

});

Route::get('/product/{id}', [ProductController::class, 'view'])
    ->name('product.id')
    ->whereNumber('id');

Route::get('/category/{id}', [CategoryController::class, 'view'])
    ->name('category.id')
    ->whereNumber('id');

Route::get('/search', [SearchController::class, 'search'])
    ->name('search');

Route::get('/', [ProductController::class, 'show'])
    ->name('dashboard');

Route::post('/user/password-change', [PasswordChangeController::class, 'edit'])
    ->name('password.change');


Route::get('/sellers', function () {
    foreach (Seller::all() as $seller) {
        echo "<h2>" . $seller->company . "</h2>";
        foreach ($seller->products as $product) {
            echo "<li>" . $product->name . "</li>";
        }
    }
})->name('sellers');

Route::prefix('/register')->group(function () {
    Route::get('/', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/', [RegisteredUserController::class, 'store']);
});

Route::prefix('/login')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::post('/', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');
});

Route::prefix('/confirm-password')->group(function () {
    Route::get('/', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('/', [ConfirmablePasswordController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
