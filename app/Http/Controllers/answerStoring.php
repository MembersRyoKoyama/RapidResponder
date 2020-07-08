<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Auth;

class answerStoring extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->session()->pull('questions_id', -1);
        if ($id < 0) {
            return redirect('questionList')->with("errors", ["最初からやり直してください"]);
        }
        $answer = new Answer;
        $answer->questions_id = $id;
        $answer->staffs_id = Auth::id();
        $answer->comment  = $request->comment;
        $answer->message  = $request->message;
        $answer->save();
        return view('answers/storeComplete');
    }
}
