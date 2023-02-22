<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');;
Route::get('/payment', [OrderController::class, 'createOrder']);
Route::get('/books/{id}', [BookController::class, 'getOneBook'])->where('id', '[0-9]+');
Route::get('/add-to-cart/{id}', [BookController::class, 'addToCart'])->where('id', '[0-9]+');
Route::patch('/update-cart', [BookController::class, 'updateCart']);
Route::delete('/remove-from-cart', [BookController::class, 'removeCart']);