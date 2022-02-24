<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;

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



Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('auth.login');
    });
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('login',[AuthController::class,'postLogin'])->name('loginPost');
    Route::post('logout',[AuthController::class,'postLogout'])->name('logoutPost');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class,'index']);
    Route::get('/users', [AdminController::class,'users']);
});

Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
    Route::get('/', [PostsController::class,'index']);
    Route::get('/add', [PostsController::class,'add']);
    Route::get('/edit', [PostsController::class,'edit']);

    Route::post('/add', [PostsController::class,'postAdd']);
    Route::post('/publish', [PostsController::class,'publish']);
    Route::delete('/delete', [PostsController::class,'delete']);
});