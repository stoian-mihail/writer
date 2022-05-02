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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin');

Route::middleware(['auth'])->group(function () {

// posts routes admin
Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'indexAdmin'])->name('admin.posts');
Route::get('/create-post', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/store-post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::post('/edit-post/{post}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::post('/delete-post/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');

// post photos admin
Route::post('/delete-post-photo/{photo}', [App\Http\Controllers\PostPhotoController::class, 'destroy'])->name('post.photo.delete');


// news routes admin

Route::get('/admin/news', [App\Http\Controllers\NewsController::class, 'indexAdmin'])->name('admin.news');
Route::get('/create-news', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
Route::post('/store-news', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
Route::post('/edit-news/{news}', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
Route::post('/delete-news/{news}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.delete');

// books routes admin

Route::get('/admin/products', [App\Http\Controllers\ProductController::class, 'indexAdmin'])->name('admin.products');
Route::get('/create-product', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/store-product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::post('/edit-product/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/delete-product/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');

Route::get('/admin/fragments', [App\Http\Controllers\FragmentController::class, 'indexAdmin'])->name('admin.fragments');
Route::get('/create-fragment', [App\Http\Controllers\FragmentController::class, 'create'])->name('fragment.create');
Route::post('/store-fragment', [App\Http\Controllers\FragmentController::class, 'store'])->name('fragment.store');
Route::post('/edit-fragment/{fragment}', [App\Http\Controllers\FragmentController::class, 'edit'])->name('fragment.edit');
Route::post('/delete-fragment/{fragment}', [App\Http\Controllers\FragmentController::class, 'destroy'])->name('fragment.delete');

});
