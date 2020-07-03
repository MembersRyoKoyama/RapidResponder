<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Question;

class QuestionsController extends Controller
{
    //問い合わせ 製品種別をpuroductsテーブルから取得
    public function form()
    {
        $products = Product::get();
        //var_dump($products);
        return view('question/index', ['products' => $products]);
    }

    public function confirm(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'name'  => 'required',
            'mail'  => 'required',
            'tel'  => 'required',
            'products_id' => 'required',
            'content' => 'required'
        ]);

        //フォームから受け取ったすべてのinputの値を取得
        $inputs = $request->all();
        $products = Product::where('id', $inputs['products_id'])->first();
        //var_dump($inputs, $products->name);
        return view('question/confirm', ['inputs' => $inputs, 'products' => $products->name]);
    }
    public function send(Request $request)
    {
        $inputs = $request->all();
        $question = new Question;
        $question->name = $inputs['name'];
        $question->mail = $inputs['mail'];
        $question->tel  = $inputs['tel'];
        $question->products_id  = $inputs['products_id'];
        $question->content  = $inputs['content'];
        $question->date  = $inputs['tel'];
        $question->end  = 1;
        var_dump($question->products_id);
        return view('question/send');
    }
    public function end()
    {
        $products = Product::get();
        return view('question/index', ['products' => $products]);
    }
}
