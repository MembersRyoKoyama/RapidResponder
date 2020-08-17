@extends('layouts.guest')
@section('content')


<div class="container">
    <div class="thx">
        <p>送信が完了しました。<br>
            ご利用いただきありがとうございます。
        </p>
    </div>
    {{--<form action="{{action('QuestionsController@end')}}" method="post">
    @csrf

    <button type="submit" class="btn submit returnbutton btn-primary" name="submit">
        Topページに戻る
    </button>
    </form>--}}
    <a class="returnbutton" href="{{action('QuestionsController@end')}}">トップページに戻る</a>
</div>
@endsection