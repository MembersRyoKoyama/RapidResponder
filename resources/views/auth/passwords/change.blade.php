@extends('layouts.app')
@section('content')

<h1>お問い合わせ内容確認ページ</h1>
<div class="container">

    <p>パスワード変更が完了しました。<br>
    </p>
    <form action="{{action('QuestionsController@end')}}" method="post">
        @csrf


        <div class="form-group text-center">
            <button type="submit" class="button">
                　ログインページに戻る
            </button>
        </div>
    </form>
</div>

@endsection