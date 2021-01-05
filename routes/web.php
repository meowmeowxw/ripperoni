<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller\SellerRegisterController;
use App\Http\Controllers\Seller\SellerSettingsController;
use App\Http\Controllers\Seller\SellerProductsController;
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

Route::prefix('/seller')->group(function() {
    Route::get('/register', [SellerRegisterController::class, 'create'])
        ->name('seller.register');
    Route::post('/register', [SellerRegisterController::class, 'store']);

    Route::get('/settings', [SellerSettingsController::class, 'create'])
        ->name('seller.settings');
    Route::post('/settings', [SellerRegisterController::class, 'store']);

    Route::get('/products', [SellerProductsController::class, 'create'])
        ->name('seller.products');
    Route::post('/products', [SellerProductsController::class, 'store']);
});

Route::get('/', [ProductController::class, 'show'])
    ->name('dashboard');

Route::get('/orders', function() {
    $orders = Auth::user()->orders()->get();
    /*
     * Example of code to use pivot... https://stackoverflow.com/questions/27038636/laravel-pivot-returning-null
     * Weird but understandable.
    $products = Order::find(1)->products;
    foreach ($products as $product) {
       echo $product->pivot->quantity."<br>";
    }
     */
    return view('orders', [
        'orders' => $orders,
        'user' => Auth::user(),
    ]);
})->middleware('auth')->name('orders');

Route::get('/sellers', function() {
    foreach (Seller::all() as $seller) {
        echo "<h2>".$seller->company."</h2>";
        foreach ($seller->products as $product) {
            echo "<li>".$product->name."</li>";
        }
    }
})->name('sellers');

Route::prefix('/users')->group(function () {

    Route::get('/', function() {
        return view('users', ['users' => User::all()]);
    });

    Route::get('/id', function() {
        foreach(User::all() as $user) {
            echo $user->id."<br>";
        }
    });

    Route::get('/{id?}', function($id) {
        $user = User::where('id', $id)->first();
        echo $user->name.", ".$user->email.", ".$user->password;
    });

    Route::get('/email', function() {
        foreach(User::all() as $user) {
            echo $user->email."<br>";
        }
    });

    Route::get('/password', function() {
        foreach(User::all() as $user) {
            echo $user->password."<br>";
        }
    });
});

Route::prefix('/register')->group(function() {
    Route::get('/', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/', [RegisteredUserController::class, 'store']);
});

Route::prefix('/login')->group(function() {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::post('/', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');
});

Route::prefix('/confirm-password')->group(function() {
    Route::get('/', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('/', [ConfirmablePasswordController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
