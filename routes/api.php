<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/book', [BookController::class, 'store']);
Route::get('/order/{id}', [OrderController::class, 'getOneOrder'])->where('id', '[0-9]+');
Route::get('/book', [BookController::class, 'getBookList']);
ROute::post('/order', [OrderController::class, 'store']);
Route::get('/search', [BookController::class, 'getBooksBy']);
