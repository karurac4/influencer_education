<?php
use Illuminate\Foundation\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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


// Auth::routes();

//Route::get('URL', [〇〇Controller::class, 'メソッド名']);
// Auth::routes([
//     'register' => false // ユーザ登録機能をオフに切替
// ]);


//ユーザー登録
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('create');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('create');

// ログイン
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
// ログアウト
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



// login
// loginからregisterに遷移
Route::get('/register', [App\Http\Controllers\UserController::class, 'register'])->name('register');



// register
// loginからregisterに遷移
Route::get('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');




//  top
// top 表示
Route::get('/top', [App\Http\Controllers\Curriculum_progressController::class, 'top'])->name('top')->middleware('auth');

// article 取得
Route::get('/top', [App\Http\Controllers\Curriculum_progressController::class, 'showArticle']);


// delivery
// delivery 表示
Route::get('/delivery', [App\Http\Controllers\Curriculum_progressController::class, 'curriculum_progress'])->name('curriculum_progress');
// Route::get('/delivery', [App\Http\Controllers\Curriculum_progressController::class, 'curriculum_progress'])->name('curriculum_progress')->middleware('auth');

// フラグ
// Route::get('/update-flag', [App\Http\Controllers\Curriculum_progressController::class, 'updateFlag'])->name('update.flag');



// topに遷移
Route::get('/top', [App\Http\Controllers\Curriculum_progressController::class, 'top'])->name('top');





