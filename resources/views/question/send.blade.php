@extends('layouts.guest')
@section('content')


<div class="container">
    <div class="thx">
        <p>送信が完了しました。<br>
            ご利用いただきありがとうございます。
        </p>
    </div>

    <a class="returnbutton btn-primary" href="{{action('QuestionsController@end')}}">Topページに戻る</a>

</div>

@endsection