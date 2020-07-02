<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class QuestionsController extends Controller
{
    //問い合わせ 製品種別をpuroductsテーブルから取得
    public function form()
    {
        $products = Product::get();
       //var_dump($products);
        return view('question/index',['products'=>$products]);
    }
}
