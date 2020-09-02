<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use App\User;
use App\Question;
use App\Answer;

use function GuzzleHttp\Promise\all;

class getQuestionsStatus extends Controller
{
    public function __invoke()
    {
        //$questions = Question::all();
        $questions = Question::orderBy('date')
            ->get()
            ->groupBy(function ($row) {
                return $row->date->format('Y-m');
            });
        $all = 0;
        $end = [0, 0, 0, 0];
        $labels = [];
        $datas = [
            'end1' => [],
            'end2' => [],
            'end3' => [],
        ];
        $i = 0;
        foreach ($questions as $key => $q) {
            $labels[] = $key;
            $datas['end1'][$i] = 0;
            $datas['end2'][$i] = 0;
            $datas['end3'][$i] = 0;
            foreach ($q as $question) {
                $all++;
                switch ($question->end) {
                    case 1:
                        $end[1]++;
                        $datas['end1'][$i]++;
                        break;
                    case 2:
                        $end[2]++;
                        $datas['end2'][$i]++;
                        break;
                    case 3:
                        $end[3]++;
                        $datas['end3'][$i]++;
                        break;
                }
            }
            $i++;
        }
        $pieData = [
            100 * $end[1] / $all, 100 * $end[2] / $all, 100 * $end[3] / $all,
        ];
        $barData = [
            'labels' => $labels,
            'datas' => $datas,
        ];
        $data = [
            'all' => $all,
            'end' => $end,
        ];
        return view('answers.supportStatus', ['data' => $data, 'pie' => $pieData, 'bar' => $barData]);
    }
}
