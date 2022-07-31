<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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
Route::get('/register', [RegisterController::class,'register']);
Route::post('/register', [RegisterController::class,'store'])->name('register');
Route::get('/login', [LoginController::class,'login']);
Route::post('/login', [LoginController::class,'authenticate'])->name('login');
Route::get('/blog/home', [BlogController::class,'home'])->name('blog.home');
Route::post('/blog/filter',[BlogController::class,'dateFilter'])->name('blog.filter');
Route::resource('blog', BlogController::class);
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
//