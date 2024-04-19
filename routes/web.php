<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\user\CurriculumController;

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

Route::view('/admin/login', 'admin/login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('admin/logout', [LoginController::class,'logout']);
Route::view('/admin/register', 'admin/register');
Route::post('/admin/register', [RegisterController::class, 'register']);
Route::view('/admin/top', 'admin/top')->middleware('auth:admin')->name('admin.top');
//Route::view('/admin/banner', '/admin/banner');
Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.banner');
Route::post('/admin/banner/list', [BannerController::class, 'list'])->name('banner.list');
Route::post('/admin/banner/update', [BannerController::class, 'update'])->name('banner.update');
Route::post('/admin/banner/delete', [BannerController::class, 'delete'])->name('banner.delete');
//お知らせ一覧ページへ(仮)
Route::view('/admin/article', 'admin/login')->name('admin.article');
//授業一覧ページへ(仮)
Route::view('/admin/curriculum', 'admin/login')->name('admin.curriculum');
//時間割ページへ(仮)
Route::get('/user/timetable', [CurriculumController::class, 'index'])->name('user.timetable');
Route::post('/user/timetable/search', [CurriculumController::class, 'search']);
Route::post('/user/timetable/classBtn', [CurriculumController::class, 'classBtn']);

//ユーザートップページへ(ダミー)
Route::view('/user/top', '/user/timetable')->middleware('auth:admin')->name('user.top');