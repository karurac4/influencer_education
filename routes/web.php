<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryTimeController;
use App\Models\DeliveryTime; 
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

Route::get('/curriculums', [CurriculumController::class, 'index']);
Route::get('/curriculums/{id}', [CurriculumController::class, 'show']);


// DeliveryTimeController のルーティング
// Route::model('deliveryTime', DeliveryTime::class);
Route::post('/delivery_times', [DeliveryTimeController::class, 'store'])->name('delivery_times.store');

// CurriculumController の配信日時表示ページへのルーティング
Route::get('/curriculums/{curriculum}/delivery-time', [CurriculumController::class, 'deliveryTime'])->name('curriculums.delivery_time');
