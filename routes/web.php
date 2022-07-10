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
Route::get('/admin', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'indexAdmin'])->name('admin.posts.index');
Route::get('/create-post', [App\Http\Controllers\PostController::class, 'create'])->name('admin.posts.create');
Route::post('/store-post', [App\Http\Controllers\PostController::class, 'store'])->name('admin.posts.store');
Route::get('/edit-post/{post}', [App\Http\Controllers\PostController::class, 'edit'])->name('admin.posts.edit');
Route::post('/delete-post/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('admin.posts.delete');
Route::post('/update-post/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('admin.posts.update');

// post photos admin
Route::post('/delete-post-photo/{photo}', [App\Http\Controllers\PostPhotoController::class, 'destroy'])->name('post.photo.delete');


// news routes admin

Route::get('/admin/news', [App\Http\Controllers\NewsController::class, 'indexAdmin'])->name('admin.news.index');
Route::get('/create-news', [App\Http\Controllers\NewsController::class, 'create'])->name('admin.news.create');
Route::post('/store-news', [App\Http\Controllers\NewsController::class, 'store'])->name('admin.news.store');
Route::get('/edit-news/{news}', [App\Http\Controllers\NewsController::class, 'edit'])->name('admin.news.edit');
Route::post('/update-news/{news}', [App\Http\Controllers\NewsController::class, 'update'])->name('admin.news.update');
Route::post('/delete-news/{news}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('admin.news.delete');

// books routes admin

Route::get('/admin/products', [App\Http\Controllers\ProductController::class, 'indexAdmin'])->name('admin.products.index');
Route::get('/create-product', [App\Http\Controllers\ProductController::class, 'create'])->name('admin.products.create');
Route::post('/store-product', [App\Http\Controllers\ProductController::class, 'store'])->name('admin.products.store');
Route::get('/edit-product/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/update-product/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('admin.products.update');
Route::post('/delete-product/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.products.delete');

Route::get('/admin/fragments', [App\Http\Controllers\FragmentController::class, 'indexAdmin'])->name('admin.fragments.index');
Route::get('/create-fragment', [App\Http\Controllers\FragmentController::class, 'create'])->name('admin.fragments.create');
Route::post('/store-fragment', [App\Http\Controllers\FragmentController::class, 'store'])->name('admin.fragments.store');
Route::get('/edit-fragment/{fragment}', [App\Http\Controllers\FragmentController::class, 'edit'])->name('admin.fragments.edit');
Route::post('/update-fragment/{fragment}', [App\Http\Controllers\FragmentController::class, 'update'])->name('admin.fragments.update');
Route::post('/delete-fragment/{fragment}', [App\Http\Controllers\FragmentController::class, 'destroy'])->name('admin.fragments.delete');

Route::get('/admin/media', [App\Http\Controllers\MultimediaController::class, 'index'])->name('admin.media.index');
Route::get('/create-media', [App\Http\Controllers\MultimediaController::class, 'create'])->name('admin.media.create');
Route::post('/store-media', [App\Http\Controllers\MultimediaController::class, 'store'])->name('admin.media.store');
Route::post('/delete-media/{media}', [App\Http\Controllers\MultimediaController::class, 'destroy'])->name('admin.media.delete');

// about me section

Route::get('/admin/about-me', [App\Http\Controllers\SiteSettingController::class, 'editAbout'])->name('admin.about');
Route::post('/admin/save-about-me', [App\Http\Controllers\SiteSettingController::class, 'saveAbout'])->name('admin.save.about');

Route::get('/admin/confidentiality', [App\Http\Controllers\SiteSettingController::class, 'editConfidentiality'])->name('admin.confidentiality');
Route::post('/admin/save-confidentiality', [App\Http\Controllers\SiteSettingController::class, 'saveConfidentiality'])->name('admin.save.confidentiality');

Route::get('/admin/terms', [App\Http\Controllers\SiteSettingController::class, 'editTerms'])->name('admin.terms');
Route::post('/admin/save-terms', [App\Http\Controllers\SiteSettingController::class, 'saveTerms'])->name('admin.save.terms');


Route::get('/admin/settings', [App\Http\Controllers\SiteSettingController::class, 'showSettings'])->name('admin.settings');

Route::get('/admin/schimbare-parola', [App\Http\Controllers\SiteSettingController::class, 'showChangePassword'])->name('admin.show.change.password');
Route::post('/admin/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changepassword'])->name('change-password');



});

// catalog routes

Route::get('/articole', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/articole/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('/evenimente/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/evenimente', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');

Route::get('/fragmente/{fragments}', [App\Http\Controllers\FragmentController::class, 'show'])->name('fragments.show');
Route::get('/fragmente', [App\Http\Controllers\FragmentController::class, 'index'])->name('fragments.index');
