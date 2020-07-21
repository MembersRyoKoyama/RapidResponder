<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class getQuestion extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->id ?? -1;
        $obj = Question::where('id', $id)->first();
        if (!$obj) {
            return redirect('questionList', 301)->with("errors", ["無効なidです"]);
        }
        session(['questions_id' => $id]);
        return view('answers/questionView', ['question' => $obj]);
    }
}
