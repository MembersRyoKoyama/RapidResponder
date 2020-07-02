<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class QuestionListingController extends Controller
{
    public function getQuestions(Request $request){
        $t = Question::where('end',$request->end??1)->get();
        return view('answers/questionList',['questions'=>$t]);
    }
}
