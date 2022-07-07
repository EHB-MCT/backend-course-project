<?php

use App\Http\Controllers\SurveyController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/surveys', function () {
    return view('surveys')->with('surveys', SurveyController::all());
})->middleware(['auth'])->name('surveys');

Route::get('/survey', function () {
    return view('survey')->with('survey', SurveyController::detail($_GET['id']));
})->middleware(['auth'])->name('survey');

require __DIR__.'/auth.php';
