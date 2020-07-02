<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class QuestionListingController extends Controller
{
    public function getQuestions(Request $request){
        $itemNum=10;
        $now=$request->p??1;
        $end=$request->end??1;
        $t=Question::where('end',$end)->get();
        $n=count($t);
        $obj=[];
        $pages=[];
        for($i=0;$i<$itemNum;$i++){
            $k=$i+($now-1)*10;
            if($k>$n-1)break;
            $obj[]=$t[$k];
        }
        for($i=1;$i<=ceil($n/$itemNum);++$i){
            $pages[]=$i;
        }
        return view('answers/questionList',['questions'=>$obj,'pages'=>$pages,"now"=>$now,"end"=>$end]);
    }
}
