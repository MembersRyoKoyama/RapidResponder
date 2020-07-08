<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
use Auth;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/questionList', 'listingQuestions');
    Route::get('/questionView', 'getQuestion');
    Route::get('/questionStateChange', 'questionStateChange');
    Route::post('/answerConfirmation', 'answerValidation');
    Route::post('/answerStoreComplete', 'answerStoring');
});

//お問い合わせ画面
Route::get('/question', 'QuestionsController@form');

Route::post('/question/confirm', 'QuestionsController@confirm');

Route::post('/question/send', 'QuestionsController@send');

Route::post('/question', 'QuestionsController@end');

//パスワードリセット
Route::post('/password/reset/end', 'Auth\ResetPasswordController@resetend');

//ログアウト
Route::get('/stafflogout', 'Auth\LogoutController@logout');


//パスワード変更完了
Route::get('/change', 'Auth\ResetPasswordController@changeend');
