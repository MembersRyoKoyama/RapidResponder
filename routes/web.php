<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
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

Route::get('/testmail', function () {
    Mail::to('test@example.com')->send(new TestMail);
    return 'メール送信完了';
});

Route::get('/questionList', 'listingQuestions');
Route::get('/questionView', 'getQuestion');
Route::get('/questionStateChange', 'questionStateChange');

//お問い合わせ画面
Route::get('/question', 'QuestionsController@form');

Route::post('/question/confirm', 'QuestionsController@confirm');

Route::post('/question/send', 'QuestionsController@send');

Route::post('/question', 'QuestionsController@end');

//パスワードリセット
Route::post('/password/reset/end', 'Auth\ResetPasswordController@resetend');

//ログアウト
Route::get('/logou', 'Auth\LogoutController@logout');
