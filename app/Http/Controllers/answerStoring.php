<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\messageMail;
use App\Answer;
use App\Question;
use Auth;

class answerStoring extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->session()->pull('questions_id', -1);
        if ($id < 0) {
            return redirect('questionList')->with("errors", ["セッションが切れました"]);
        }
        if (Question::where('id', $id)->first()->staffs_id != Auth::id()) {
            return back()->with("errors", ["権限がありません"]);
        }
        $answer = new Answer;
        $answer->questions_id = $id;
        $answer->staffs_id = Auth::id();
        $answer->comment  = $request->comment;
        $answer->message  = $request->message;
        $answer->save();
        $mailAddress = Question::where('id', $id)->first()->mail;
        Mail::to($mailAddress)->send(new messageMail($answer));
        return view('answers/storeComplete');
    }
}
