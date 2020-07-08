@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-center">送信確認</h1>
  <div class="container">
    <form method="post" action="/answerStoreComplete">
      @csrf
      メッセージ内容
      <textarea name="message" id="confirmationForm" class="confirmationForm form-control" type="text" readonly>{{
        $inputs['message']
    }}</textarea>
      コメント内容
      <textarea name="comment" id="confirmationForm" class="form-control" type="text" readonly>{{
        $inputs['comment']
    }}</textarea>
      <a class="btn btn-danger" href="javascript:history.back()">修正する</a>
      <button class="btn btn-primary" type="submit">送信する</button>
    </form>
  </div>
</div>
@endsection