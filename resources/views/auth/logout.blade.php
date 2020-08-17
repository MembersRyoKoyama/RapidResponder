@extends('layouts.app')
@section('content')

<h1></h1>
<div class="container">
    <div class="content">
        <p>ログアウトします<br>
            よろしいですか。
        </p>
    </div>
    <form method="post" name="form1" action="{{ route('logout') }}">
        @csrf
        <input type="hidden" name="user_name" value="名前">
        <a href="javascript:form1.submit()" class="logout btn btn-primary">はい</a>
    </form>

    <div class="col-sm-offset-3 col-sm-6">
        <a class="cancel back-button btn btn-primary" href="javascript:history.back()">キャンセル</a>
    </div>
</div>

@endsection