<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;



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

// Route::get('/vender/login', function () {
//     $venders = \App\Models\Vender::all();
//     return view('/', ['venders' => $venders]);
// });
// Route::get('/vender/login', 'AuthController@showLogin');

// Route::get('/vender/login','App\Http\Controllers\VenderController@loginForm');

// Route::post('/success','App\Http\Controllers\VenderController@loginForm')->name('success');

/* 
    getのあと、’指定したいurl’,’どのコントローラー使うのか’
*/
// ログインフォーム
Route::get('/', [AuthController::class, 'showLogin']) ->name('showLogin');

// ログイン処理
Route::post('login', [AuthController::class, 'login'])->name('login');

//ログイン後のホーム画面へ
Route::get('home', function() {
    return view('home');
})->name('home');