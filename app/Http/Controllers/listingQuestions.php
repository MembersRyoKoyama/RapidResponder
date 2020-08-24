<?php

namespace App\Http\Controllers;

use DB;
use App\Question;
use App\Tag;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;

class listingQuestions extends Controller
{
    public function __invoke(Request $request)
    {
        $itemNum = 8;
        $now = $request->p ?? 1;
        $end = $request->end ?? 1;
        $tagids = explode(',', $request->tagids);

        $t = [];
        if ($tagids[0] !== "") {
            $tt = Question::where('end', $end)->orderBy('date')->get();
            foreach ($tt as $question) {
                $ttt = [];
                foreach ($question->tags()->orderBy('id')->get()->toArray() as $tags) {
                    $ttt[] = $tags['id'];
                }
                if ($ttt == $tagids) $t[] = $question;
            }
        } else {
            $t = Question::where('end', $end)->orderBy('date')->get();
        }
        $n = count($t);
        $tags = Tag::all();
        $obj = [];
        $pages = [];
        for ($i = 0; $i < $itemNum; $i++) {
            $k = $i + ($now - 1) * $itemNum;
            if ($k > $n - 1) break;
            $t[$k]['tags'] = $t[$k]->tags()->orderBy('id')->get();
            $obj[] = $t[$k];
        }
        for ($i = 1; $i <= ceil($n / $itemNum); ++$i) {
            $pages[] = $i;
        }
        return view('answers/questionList', ['questions' => $obj, 'pages' => $pages, 'now' => $now, 'end' => $end, 'tags' => $tags]);
    }
}
