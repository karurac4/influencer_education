<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ArticleController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'method:_PUT'], function () {
    // PUTメソッドをサポートするルーティングの処理を記述
    Route::put('admin/articles', function () {
        // ルーティングの処理を記述
    });
});

// Route::view('/admin/login', 'admin/login');
// Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
// Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class,'logout']);
// Route::view('/admin/register', 'admin/register');
// Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
// Route::view('/admin/home', 'admin/home')->middleware('auth:admin');
// Route::view('/admin/password/reset', 'admin/passwords/email');
// Route::post('/admin/password/email', [App\Http\Controllers\admin\ForgotPasswordController::class, 'sendResetLinkEmail']);
// Route::view('/admin/password/reset/{token}', [App\Http\Controllers\admin\ResetPasswordController::class,'showResetForm']);
// Route::post('/admin/password/reset', [App\Http\Controllers\admin\ResetPasswordController::class, 'reset']);

// Route::get('/user/progress/{userId}', 'UserController@progress');
Route::get('/user/progress/{userId}', [App\Http\Controllers\UserController::class,'progress'])->name('user.progress');
// Route::get('/user/articles/{articleId}', 'UserController@article');
Route::get('/user/articles', [App\Http\Controllers\UserController::class,'article'])->name('user.articles');
// Route::get('/user/edit', 'UserController@edit')->name('user.edit');
Route::get('/user/edit', [App\Http\Controllers\UserController::class,'edit'])->name('user.edit');
// Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/update', [App\Http\Controllers\UserController::class,'update'])->name('user.update');

// Route::get('/password/change', 'PasswordController@change')->name('password.change');
Route::get('/password/change', [App\Http\Controllers\PasswordController::class,'change'])->name('password.change');
// Route::post('/password/change', 'PasswordController@update')->name('password.update');
Route::post('/password/change', [App\Http\Controllers\PasswordController::class,'update'])->name('password.update');

// Route::get('/admin/articles/{article}/edit', 'ArticleController@edit')->name('admin.articles.edit');
Route::get('/admin/articles/edit/{id}', [App\Http\Controllers\ArticleController::class,'edit'])->name('admin.articles.edit');
// Route::put('/admin/articles/{article}', 'ArticleController@update')->name('admin.articles.update');
Route::put('/admin/articles/update/{id}', [App\Http\Controllers\ArticleController::class,'update'])->name('admin.articles.update');
// Route::get('/admin/articles', 'ArticleController@index')->name('admin.articles.index');
Route::get('/admin/articles/index', [App\Http\Controllers\ArticleController::class,'index'])->name('admin.articles.index');
// Route::delete('/admin/articles/{article}', 'ArticleController@destroy')->name('admin.articles.destroy');
Route::delete('/admin/articles/{article}', [App\Http\Controllers\ArticleController::class,'destroy'])->name('admin.articles.destroy');

Route::get('/admin/articles', [App\Http\Controllers\ArticleController::class,'create'])->name('admin.articles.create');
Route::get('/admin/articles/store', [App\Http\Controllers\ArticleController::class,'store'])->name('admin.articles.store');

// Route::group(['middleware' => 'auth'], function () {
//     Route::resource('/admin/articles', ArticleController::class);
// });