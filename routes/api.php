<?php

use App\Http\Controllers\ProductsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products',[ProductsController::class,'index']);// Index all product
Route::post('/product',[ProductsController::class,'store']);// Create product
Route::get('/product/show/{id}',[ProductsController::class,'show']);//Show product for id
Route::put('/product/update/{id}',[ProductsController::class,'update']);//Update product
Route::delete('/product/delete/{id}',[ProductsController::class,'destroy']);//Delete product
