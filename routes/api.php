<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\booksController;
// use App\Http\Controllers\API\booksController.php;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', [booksController::class, 'index']);
Route::post('store', [booksController::class, 'store']);
Route::get('books/{id}',[booksController::class, 'show']);
Route::get('books/',[booksController::class, 'name']);
Route::put('books/{id}/update',[booksController::class, 'update']);
