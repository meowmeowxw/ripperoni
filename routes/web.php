<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Models\User;
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

Route::get('/', [ProductController::class, 'show'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/orders', function() {
    $orders = Auth::user()->orders()->get();
    return view('orders', [
        'orders' => $orders,
        'user' => Auth::user(),
    ]);
});

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
