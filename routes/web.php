<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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
});

Route::get('/hello/{name?}/{id?}', function ($name = 'meowmeowxw', $id = '0') {
    return view('hello', ['name' => $name, 'id' => $id]);
})->whereNumber('id')->whereAlphaNumeric('name');

Route::get('/profile', function () {
    return 'success';
})->middleware('token.valid');

Route::prefix('/users')->group(function () {

    Route::get('/', function() {
        foreach(User::all() as $user) {
            echo $user->name."<br>";
        }
    });

    Route::get('/email', function() {
        foreach(User::all() as $user) {
            echo $user->email."<br>";
        }
    });
});

Route::get('/users/{user}', function (User $user) {
    return view('hello', ["name" => $user->getKeyName()]);
});
