<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
use App\Mail\GuestMail;
use App\Mail\MessageMail;
use Illuminate\Support\Facades\Mail;
use App\Answer;
use App\Question;
//use Auth;
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

Route::get('mailable', function () {
    $que = App\Question::find(1);
    $ans = App\Answer::find(1);
    Mail::to($que->mail)->send(new App\Mail\messageMail($ans, $que));
    return new App\Mail\messageMail($ans, $que);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('/questionList');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/questionList', 'listingQuestions');
    Route::get('/questionView', 'getQuestion');
    Route::get('/questionStateChange', 'questionStateChange');
    Route::post('/answerConfirmation', 'answerValidation');
    Route::post('/answerStoreComplete', 'answerStoring');
});

//お問い合わせ画面
Route::get('/question', 'QuestionsController@form')->name('question');

//お問い合わせ確認画面
Route::post('/question/confirm', 'QuestionsController@confirm')->name('questionConfirm');
Route::get('/question/confirm', function () {
    return redirect('/question')->with("errors", ["無効な操作です"]);
});

//送信完了画面
Route::post('/question/send', 'QuestionsController@send')->name('questionSend');
Route::get('/question/send', function () {
    return redirect('/question')->with("errors", ["無効な操作です"]);
});

Route::post('/question', 'QuestionsController@end');

//パスワードリセット
Route::post('/password/reset/end', 'Auth\ResetPasswordController@resetend')->name('resetEnd');

//ログアウト
Route::get('/stafflogout', 'Auth\LogoutController@logout')->name('staffLogout');

//パスワード変更完了
Route::get('/change', 'Auth\ResetPasswordController@changeend')->name('passwordChange');
