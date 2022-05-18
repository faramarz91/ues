<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TakeTestController;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/exam')
    ->name('take-test.')
//      could prevent of take exam to admin or teacher role groups,
//      but they could take test also they record does not apply on database
//      and their test (admin & teacher) don't affect the results
    ->middleware(['auth'/*, 'role:'.\App\Enums\UserRole::Student->value*/])
    ->controller(TakeTestController::class)
    ->group(function ()
    {
        Route::get('/list','index')->name('index');
        Route::get('/{exam:exam_id}/result','result')->name('result');
        Route::get('/{exam:id}','doExam')->name('do');
        Route::post('/{exam:id}', 'storeExam')->name('store');

    });

