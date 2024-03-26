<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

//Route::get('/', 'App\Http\Controllers\BlogController@showList')->name('blogs');

//Route::get('/blog/{id}', 'App\Http\Controllers\BlogController@showDetail')->name('show');

Route::get('/', [BlogController::class, 'showList'])->name('blogs');

//ブログ投稿画面の表示
Route::get('/blog/create', [BlogController::class, 'showCreate'])->name('create');

//ブログ投稿機能
Route::post('/blog/store', [BlogController::class, 'exeStore'])->name('store');

//ブログ詳細画面の表示
Route::get('/blog/{id}', [BlogController::class, 'showDetail'])->name('show');

//ブログ編集画面の表示
Route::get('/blog/edit/{id}', [BlogController::class, 'showEdit'])->name('edit');

//ブログ更新機能
Route::post('/blog/update', [BlogController::class, 'exeUpdate'])->name('update');

//ブログ削除機能
Route::post('/blog/delete/{id}', [BlogController::class, 'exeDelete'])->name('delete');