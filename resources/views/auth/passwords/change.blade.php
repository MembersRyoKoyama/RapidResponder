@extends('layouts.app')
@section('content')


<div class="container">
    <div class="passchange">
        <p>パスワード変更が完了しました。<br>
        </p>
    </div>
    <form action="{{route('resetEnd')}}" method="post">
        <?php /*<form action="{{action('QuestionsController@end')}}" method="post">*/ ?>
        @csrf

        <div class="form-group text-center">

            　<a class="returnpage btn btn-primary" href="/login">{{ __('お問い合わせ画面に戻る') }}</a>
            <?php /*<a class="nav-link" href="{{ route('login')}}">{{ __('ログインページに戻る') }}</a>*/ ?>
        </div>
    </form>
</div>

@endsection