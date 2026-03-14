<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//import controller ProductController
use App\Http\Controllers\Api\ProductController;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Api\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//products
Route::apiResource('/products', ProductController::class);

Route::apiResource('/books', BookController::class);
