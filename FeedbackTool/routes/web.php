<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('dashboard');
})->middleware(['auth'])->name('welcome');

/*
|--------------------------------------------------------------------------
| Get request pages
|--------------------------------------------------------------------------
*/

// show users
Route::get('/clients', function () {
    return view('clients')->with('users', UserController::index());
})->middleware(['auth'])->name('clients');
Route::get('/statistics', function () {
    return view('clients')->with('users', UserController::index());
})->middleware(['auth'])->name('statistics');

// show user
Route::get('/client', function () {
    return view('client')->with('user', UserController::indexOnUserId($_GET['id']));
})->middleware(['auth'])->name('client');

// show surveys
Route::get('/public-surveys', function () {
    return view('surveys')->with('surveys', SurveyController::index());
})->middleware(['auth'])->name('public-surveys');
Route::get('/surveys', function () {
    return view('surveys')->with('surveys', SurveyController::privateSurveys());
})->middleware(['auth'])->name('surveys');

// Show questions corresponding to a survey
Route::get('/survey', function () {
    return view('survey')->with('survey', QuestionController::indexOnSurveyId($_GET['id']));
})->middleware(['auth'])->name('survey');

/*
|--------------------------------------------------------------------------
| Post requests
|--------------------------------------------------------------------------
*/

// Create a new survey
Route::post('addSurvey', [SurveyController::class, "store"]
)->middleware(['auth'])->name('addSurvey');

// Add a new Question to a survey
Route::post('addQuestion', [QuestionController::class, "store"]
)->middleware(['auth'])->name('addQuestion');

require __DIR__.'/auth.php';
