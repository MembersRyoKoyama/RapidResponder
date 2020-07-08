@extends('layouts.guest')
@section('content')


<div class="container">

    <p>送信が完了しました。<br>
        ご利用いただきありがとうございます。
    </p>
    <form action="{{action('QuestionsController@end')}}" method="post">
        @csrf


        <div class="form-group text-center">
            <button type="submit" class="button">
                　Topページに戻る
            </button>
        </div>
    </form>
</div>

@endsection