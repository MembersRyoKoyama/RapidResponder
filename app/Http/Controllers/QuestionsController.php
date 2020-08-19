<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Question;
use App\Mail\GuestMail;
use Illuminate\Support\Facades\Mail;

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
            'name'  => 'required | max:16',
            'mail'  => 'required | email | max:200',
            'tel'  => 'required | numeric |digits_between:9,12',
            //'products_id' => 'required ',
            //| digits_between:9,11'
            'content' => 'required | max:2000'
        ]);

        //フォームから受け取->ったすべてのinputの値を取得
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
        $question->end  = 1;
        $question->save();

        //var_dump($question->products_id);
        //Mail::to($inputs['mail'])->send(new GuestMail);

        Mail::to($inputs['mail'])->send(new GuestMail($question));
        return view('question/send');
    }
    public function end()
    {
        $products = Product::get();
        return view('question/index', ['products' => $products]);
    }
}
