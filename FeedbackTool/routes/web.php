<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurvlistController;
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
    return view('dashboard')->with('sessions', responseController::index());
})->middleware(['auth'])->name('welcome');

Route::group(['middleware' => ['permission:client']], function () {
    // Show session
    Route::get('/session', function () {
        return view('session')->with('question', responseController::sessionOnId($_GET['id']));
    })->middleware(['auth'])->name('session');

    // Create a new response
    Route::post('addResponse', [ResponseController::class, "store"]
    )->middleware(['auth'])->name('addResponse');
});

Route::group(['middleware' => ['permission:caretaker']], function () {

    /*
    |--------------------------------------------------------------------------
    | Get request pages
    |--------------------------------------------------------------------------
    */

    // show users so you can get to their statistics
    Route::get('/clients', function () {
        return view('clients')->with('users', UserController::index());
    })->middleware(['auth'])->name('clients');
    Route::get('/statistics', function () {
        return view('clients')->with('users', UserController::index());
    })->middleware(['auth'])->name('statistics');

    // show user and their statistics
    Route::get('/client', function () {
        return view('client')->with('user', UserController::indexOnUserId($_GET['id']));
    })->middleware(['auth'])->name('client');

    // show public- and private surveys (still all visible to moderators and up)
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

    // Show sessions
    Route::get('/sessions', function () {
        return view('sessions')->with('user', SessionController::index());
    })->middleware(['auth'])->name('sessions');

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

    // Create a new survey list
    Route::post('addSurvlist', [SurvlistController::class, "store"]
    )->middleware(['auth'])->name('addSurvlist');

    // Create a new session
    Route::post('addSession', [SessionController::class, "store"]
    )->middleware(['auth'])->name('addSession');
});

// test get route for testing my controller data
Route::get('/test', function () {
    return view('testpage')->with('user', SessionController::index());
})->middleware(['auth'])->name('test');

require __DIR__.'/auth.php';
