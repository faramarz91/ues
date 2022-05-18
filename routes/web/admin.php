<?php

use App\Http\Controllers\AnalyzeController;
use App\Http\Controllers\ExamController;
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
Route::resource('exams', ExamController::class);
Route::patch('exams/{exam:id}/submit', [ExamController::class, 'submit'])->name('exam.submit');

Route::get('analyze', AnalyzeController::class)->name('analyze');
