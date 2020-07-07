@extends('layouts.app')
@section('content')

<h1>お問い合わせ内容確認ページ</h1>
<div class="container">

    <p>こちらの内容でよろしければ送信してください</p>
    <form action="{{action('QuestionsController@send')}}" method="post">
        @csrf
        <!--ゲストの問い合わせフォーム -->
        <label>氏名</label><br>
        <input type="text" name="name" value="{{$inputs['name']}}"><br>

        <label>メールアドレス</label><br>
        <input type="text" name="mail" 　value="{{$inputs['mail']}}"><br>

        <label>電話番号</label><br>
        <input type="text" name="tel" value="{{$inputs['tel']}}"><br>

        <label>製品種別</label><br>
        <input type="text" name="products_id" value="{{$inputs['products_id']}}" hidden>
        <input type="text" value="{{$products}}"><br>

        <label>お問い合わせ内容</label><br>
        <textarea name="content" cols="50" rows="5">{{$inputs['content']}}</textarea>

        <div class="form-group ">
            <button type="submit" class="button">
                　送信する
            </button>
        </div>

    </form>
</div>

@endsection