<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SearchController;



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

/* 
    getのあと、’指定したいurl’,’どのコントローラー使うのか’
*/
//ログイン前の処理
Route::group(['middleware'=> ['guest']],function() {
    // ログインフォーム
    Route::get('/', [AuthController::class, 'showLogin']) ->name('showLogin');

    // ログイン処理
    Route::post('login', [AuthController::class, 'login'])->name('login');

    
});


//ログイン後の処理
Route::group(['middleware'=> ['auth']],function() {
    
    // Route::get('home', function() {
    //     return view('home');
    // })->name('home');
        
        
    //ログイン後のホーム画面(商品一覧)へ
    Route::get('home',[SearchController::class, 'searchProductlist'])->name('searchProductlist');

    //商品詳細ページ
    Route::get('/product/{id}',[SearchController::class, 'showDetail'])->name('showDetail');


    //ログアウト
    Route::post('logout',
    [AuthController::class, 'logout'])->name('logout');
        

});



//ユーザー新規登録画面表示
Route::get('register', [AuthController::class, 'showRegister']) ->name('showRegister');


//ユーザー登録
Route::post('register/create',[AuthController::class, 'userCreate'])->name('userCreate'); 
