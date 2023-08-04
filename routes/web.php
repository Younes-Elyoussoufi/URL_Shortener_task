<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::middleware('auth')->group( function(){
Route::post('logout',[UserController::class,'logout'])->name('logout');
Route::get('/', function () {
    return view('home');
});
} );
Route::get('user/register',[UserController::class,'registerForm'])->name('register');
Route::post('user/register',[UserController::class,'store'])->name('register');
Route::get('user/login',[UserController::class,'loginForm'])->name('login');
Route::post('user/login',[UserController::class,'login'])->name('login');
Route::get('visit/{shorten_url}',[UrlController::class,'show'])->name('show');
