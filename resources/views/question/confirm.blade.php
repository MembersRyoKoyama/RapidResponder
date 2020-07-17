@extends('layouts.guest')
@section('content')


<div class="container confirmcontent">

    <p>こちらの内容で送信します</p>
    <p>問題ないですか</p>
    <form action="{{action('QuestionsController@send')}}" method="post">
        @csrf
        <!--ゲストの問い合わせフォーム -->
        <label>氏名</label><br>
        <input type="text" name="name" value="{{$inputs['name']}}" readonly><br>

        <label>メールアドレス</label><br>
        <input type="text" name="mail" 　value="{{$inputs['mail']}}" readonly><br>

        <label>電話番号</label><br>
        <input type="text" name="tel" value="{{$inputs['tel']}}" readonly><br>

        <label>製品種別</label><br>
        <input type="text" name="products_id" value="{{$inputs['products_id']}}" hidden>
        <input type="text" value="{{$products}}" readonly><br>

        <label>お問い合わせ内容</label><br>
        <textarea name="content" cols="50" rows="5" readonly>{{$inputs['content']}}</textarea>


        <div class="form-group ">
            <a class="btn btn-primary correction inline-block_test" href="javascript:history.back()">　修正する　</a>
            <button type="submit" class="btn btn-primary submit inline-block_test">
                送信する
            </button>

        </div>
    </form>
</div>

@endsection