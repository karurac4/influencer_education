<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryTimeController;
use App\Models\DeliveryTime; 
// use App\Http\Controllers\TestController;
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

Route::get('/curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
Route::get('/curriculums/{id}', [CurriculumController::class, 'show']);
Route::get('/curriculums/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
Route::put('/curriculums/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');

// Gradeを表示するルーティング
Route::get('/grades/{id}', [CurriculumController::class, 'showGrade'])->name('grade.show');
// gradeのリンクの非同期処理
Route::get('/getCurriculums', [CurriculumController::class, 'getCurriculums']);

// DeliveryTimeController のルーティング
Route::post('/delivery_times', [DeliveryTimeController::class, 'store'])->name('delivery_times.store');
Route::get('/get-delivery-times', [DeliveryTimeController::class, 'getDeliveryTimes'])->name('get_delivery_times');
Route::get('/delivery-times', [DeliveryTimeController::class, 'index'])->name('delivery_times.index');
Route::get('/curriculums/{curriculum}/delivery_times/edit', [DeliveryTimeController::class, 'edit'])->name('delivery_times.edit');

// CurriculumController の配信日時表示ページへのルーティング
Route::get('/curriculums/{curriculum}/delivery-time', [CurriculumController::class, 'deliveryTime'])->name('curriculums.delivery_time');


Route::get('/test', [CurriculumController::class, 'test']);