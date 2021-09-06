<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\StarterQuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/author', [HomeController::class, 'author'])->name('author');



Route::get('/goBack', [HomeController::class, 'goBack'])->name('goBack');
Route::post('/login', [HomeController::class, 'logUser'])->name('logUser');

Route::put('/reportUser/{id}', [HomeController::class, 'reportUser'])->name('reportUser');


//Route::resource('/answer', AnswerController::class);
Route::resource('/user', UserController::class);


Route::middleware(['loggedIn'])->group(function () {
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    Route::post('/answerQuestion/{id}/{id2}/{userFrom?}', [HomeController::class, 'answerOnQuestion'])->name('answerOnQuestion');
    Route::put('/answerOnQuestionInsert/{id}/{id2}', [HomeController::class, 'answerOnQuestionInsert'])->name('answerOnQuestionInsert');

    Route::put('/sendQuestion/{id}/{id2}', [HomeController::class, 'sendQuestion'])->name('sendQuestion');

    Route::get('/userQuestions', [HomeController::class, 'userQuestions'])->name('userQuestions');

    Route::resource('/question', QuestionController::class);
    Route::resource('/notifications', NotificationsController::class);
    Route::get('/getUsers/{key}', [HomeController::class, 'getUsers'])->name('getUsers');
    Route::delete('/deleteAnswer/{id}', [HomeController::class, 'deleteAnswer'])->name('deleteAnswer');
    Route::put('/changeRole/{role_id}/{user_id}', [HomeController::class, 'changeRole'])->name('changeRole');

});

Route::middleware(['loggedInAdmin'])->group(function (){
    Route::resource('/starterQuestion', StarterQuestionController::class);

});
