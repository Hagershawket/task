<?php

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

Auth::routes();

Route::get('/', function () {
    return view('empty');
});


Route::get('home'             , [App\Http\Controllers\PostController::class, 'index']);
Route::post('store'           , [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::post('destroy'         , [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
Route::post('like'            , [App\Http\Controllers\PostController::class, 'likePost'])->name('like');
Route::get('posts/{id}'       , [App\Http\Controllers\PostController::class, 'posts'])->name('posts');
Route::get('comments/{id}'    , [App\Http\Controllers\CommentController::class, 'getComments'])->name('getComments');
Route::post('comments/store'  , [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
