<?php

use App\Http\Controllers\UrlController;
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

Route::post('url/add',[UrlController::class,'store']);
Route::get('/user/urls/{user_id}',[UrlController::class,'index']);
Route::get('/user/urls/visited/{user_id}',[UrlController::class,'mostVisited']);
Route::delete('/url/delete/{shorten_url}',[UrlController::class,'destroy']);
Route::put('/url/update/{shorten_url}',[UrlController::class,'update']);
