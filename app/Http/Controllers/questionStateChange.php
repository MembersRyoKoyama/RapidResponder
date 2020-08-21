<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use App\Tag;
use Illuminate\Http\Request;

class questionStateChange extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->id ?? -1;
        $to = $request->to ?? -1;
        $obj = Question::where('id', $id)->first();
        if (!$obj) {
            return redirect('questionList')->with("errors", ["無効なidです"]);
        }
        $end = $obj->end;
        if (($to < 1 || $to > 3) || ($end == 1 && $to == 3) || ($end == 3 && $to == 2) || ($end == $to)) {
            return redirect('questionList')->with("errors", ["無効な状態です"]);
        }
        if (($end == 2 || $end == 3) && $obj->staffs_id != Auth::id()) {
            return back()->with("errors", ["権限がありません"]);
        }
        if ($end == 1 && $to == 2) {
            $obj->update(['staffs_id' => Auth::id()]);
        } else if ($to == 1) {
            $obj->update(['staffs_id' => null]);
        }
        $obj->update(['end' => $to]);
        $tags = Tag::all();
        return view('answers/questionView', ['question' => $obj, 'tags' => $tags]);
    }
}
