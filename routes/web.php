<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;



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

/************************* ログイン前の処理 *************************/
Route::group(['middleware'=> ['guest']],function() {

    // ログインフォーム
    Route::get('/', [AuthController::class, 'showLogin']) ->name('showLogin');

    // ログイン処理
    Route::post('login', [AuthController::class, 'login'])->name('login');
 
});



/************************* ログイン後の処理 *************************/

Route::group(['middleware'=> ['auth']],function() {
    
    //ログイン後のホーム画面(商品一覧)へ
    Route::get('home',[SearchController::class, 'searchProductlist'])->name('searchProductlist');

    //商品詳細ページ
    Route::get('/product/{id}',[SearchController::class, 'showDetail'])->name('showDetail');

    //ログアウト
    Route::post('logout',
    [AuthController::class, 'logout'])->name('logout');
});


/******************** ユーザー登録 ********************/

//ユーザー新規登録画面表示
Route::get('register', [AuthController::class, 'showRegister']) ->name('showRegister');


//ユーザー登録
Route::post('register/add',[AuthController::class, 'userAdd'])->name('userAdd'); 


/********************  アイテム検索  ********************/

//キーワード検索
Route::get('productlist/productSearch', [SearchController::class, 'productSearch'])->name('productSearch');

//メーカー検索
Route::get('productlist/companySearch', [SearchController::class, 'companySearch'])->name('companySearch');

//価格検索
Route::get('productlist/priceSearch', [SearchController::class, 'priceSearch'])->name('priceSearch');

//在庫検索
Route::get('productlist/stockSearch', [SearchController::class, 'stockSearch'])->name('stockSearch');



/********************  アイテム登録  ********************/

//商品新規登録画面表示
Route::get('/productAdd', [ProductController::class, 'showProductAdd']) ->name('showProductAdd');

//商品登録
Route::post('/productAdd/add',[ProductController::class, 'productAdd'])->name('productAdd'); 



/********************  アイテム編集  ********************/

//商品編集画面表示
Route::get('/showUpdate/{id}', [ProductController::class, 'showUpdate']) ->name('showUpdate');

//商品編集
Route::post('/update/',[ProductController::class, 'productUpdate'])->name('productUpdate'); 
// Route::get('/redirectUpdate/', [ProductController::class, 'showUpdate']) ->name('redirectUpdate');


/********************  アイテム削除  ********************/

//商品削除
Route::post('/productDelete/delete/{id}',[ProductController::class, 'productDelete'])->name('productDelete'); 
