@extends('layouts.app')
@section('content')


<div class="container">

    <p>パスワード変更が完了しました。<br>
    </p>
    <form action="{{action('QuestionsController@end')}}" method="post">
        <?php /*<form action="{{action('QuestionsController@end')}}" method="post">*/ ?>
        @csrf

        <div class="form-group text-center">
            <button type="submit" class="button">
                　<a class="nav-link" href="/login">{{ __('ログインページに戻る') }}</a>
                <?php /*<a class="nav-link" href="{{ route('login')}}">{{ __('ログインページに戻る') }}</a>*/ ?>
            </button>
        </div>
    </form>
</div>

@endsection