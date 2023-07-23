<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//商品一覧画面
Route::get('/list', [App\Http\Controllers\TestProductController::class, 'showList'])
->name('list_product');
//新規登録ボタン押下
Route::get('/product/create', [App\Http\Controllers\TestProductController::class, 'create'])
->name('product.create');
//登録ボタンを押下
Route::POST('/product/store', [App\Http\Controllers\TestProductController::class, 'store'])
->name('product.store');
//詳細ボタン押下
Route::get('/product/detail/{id}',[App\Http\Controllers\TestProductController::class, 'showDetail'])
->name('product.detail');
//削除ボタン押下
Route::delete('/product/delete/{id}',[App\Http\Controllers\TestProductController::class, 'delete'])
->name('product.delete');
//編集ボタン押下
Route::get('product/edit/{id}',[App\Http\Controllers\TestProductController::class, 'edit'])
->name('product.edit');
//編集変更
Route::POST('/product/update',[App\Http\Controllers\TestProductController::class, 'update'])
->name('product.update');
//検索ボタン押下
Route::get('/product/search',[App\Http\Controllers\TestProductController::class, 'search'])
->name('product.search');
//更新ボタンを押下
Route::put('/product/update/{id}',[App\Http\Controllers\TestProductController::class, 'update'])
->name('product.update');


