<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
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
        if ($to < 1 && $to > 3) {
            return redirect('questionList')->with("errors", ["無効な状態です"]);
        }
        var_dump($obj->end, $obj->staffs_id);
        if ($obj->end == 2 && $obj->staffs_id != Auth::id()) {
            return back()->with("errors", ["権限がありません"]);
        }
        if ($obj->end == 1 && $to == 2) {
            $obj->update(['staffs_id' => Auth::id()]);
        } else if ($to == 1) {
            $obj->update(['staffs_id' => null]);
        }
        $obj->update(['end' => $to]);
        return back();
    }
}
