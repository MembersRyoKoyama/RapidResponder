@extends('layouts.app')
@section('content')

<h1></h1>
<div class="container">

    <p>ログアウトしますか？<br>
    </p>

    <form method="post" name="form1" action="{{ route('logout') }}">
        @csrf
        <input type="hidden" name="user_name" value="名前">
        <a href="javascript:form1.submit()">logout</a>
    </form>

    <div class="col-sm-offset-3 col-sm-6">
        <a class="back-button" href="/">　戻る　</a>
    </div>
</div>

@endsection