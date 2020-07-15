@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/confirmation.css') }}" rel="stylesheet">
<link href="{{ asset('css/button.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
  <h1 class="text-center">送信確認</h1>
  <div class="container">
    <form method="post" action="/answerStoreComplete">
      @csrf
      メッセージ内容
      <textarea name="message" id="message" class="confirmationForm form-control" type="text" readonly>{{
        $inputs['message']
    }}</textarea>
      コメント内容
      <textarea name="comment" id="comment" class="confirmationForm form-control" type="text" readonly>{{
        $inputs['comment']
    }}</textarea>
      <div class="buttonWrapper">
        <a class="button" href="javascript:history.back()">修正する</a>
        <button class="button" type="submit">送信する</button>
      </div>
    </form>
  </div>
</div>
@endsection