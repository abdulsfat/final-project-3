<?php

use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth:sanctum')->group(function () {
// Method POST
Route::post('/news', [NewsController::class, 'store']);

// Method PUT
Route::put('/news/{id}', [NewsController::class, 'update']);

// Method DELETE
Route::delete('/news/{id}', [NewsController::class, 'destroy']);
});

// Method GET
Route::get('/news', [NewsController::class, 'index']);

// Method POST
Route::post('/news', [NewsController::class, 'store']);

// Method GET
Route::get('/news/{id}', [NewsController::class, 'show']);

// Method GET
Route::get('/news/search/{title}', [NewsController::class, 'search']);

// Method GET
Route::get('/news/category/sport', [NewsController::class, 'sport']);

// Method GET
Route::get('/news/category/finance', [NewsController::class, 'finance']);

// Method GET
Route::get('/news/category/automotive', [NewsController::class, 'automotive']);
