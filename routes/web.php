<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testmail', function(){
    Mail::to('test@example.com')->send(new TestMail);
    return 'メール送信完了';
});
<<<<<<< HEAD
Route::get('/answerList', function(){
    return view('answers.list');
});

=======
Route::get('/questionList', 'QuestionListingController@getQuestions');
>>>>>>> 57a09a73463756b3735bdd1d24915eb272731571
