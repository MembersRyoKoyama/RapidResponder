@extends('layouts.app')
@push('scripts')
<script src="{{ asset('js/sendAnswerForm.js') }}"></script>
@endpush
@push('styles')
<link href="{{ asset('css/questionView.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container" id="questionViewTable">
  <h1 class="text-center">お問い合わせ詳細</h1>
  <table class="table table-sm table-borderless">
    <tbody>
      <tr class="d-flex">
        <th class="col-3 h3">{{$question->name}}</th>
        <td class="col-7 text-right">状態</td>
        <td class="col-2">
          <x-end-icon end="{{$question->end}}}" />
        </td>
      </tr>
      <tr class="d-flex">
        <th class="col-3">お問い合わせ日時</th>
        <td class="col-3">{{$question->date}}</td>
        <td class="col-4 text-right">スタッフ名</td>
        <td class="col-2">
          {{$question->users==null?'名無し':$question->users->name}}
        </td>
      </tr>
      <tr class="d-flex">
        <th class="col-3">電話番号</th>
        <td class="col-3">{{$question->tel}}</td>
      </tr>
      <tr class="d-flex">
        <th class="col-3">製品番号</th>
        <td class="col-3">{{$question->products->name}}</td>
      </tr>
      <tr class="d-flex">
        <th class="col-3">お問い合わせ内容</th>
        <td class="col-9">
          @foreach($tags as $tag)
          {{$tag->name}}
          @endforeach
        </td>
      </tr>
      <tr class="d-flex">
        <td class="text-left">{{$question->content}}</td>
      </tr>

      <tr class="d-flex">
        <td class="col-12 text-right stateChangeButton">
          @switch($question->end)
          @case(1)
          <x-state-change-button to="2" :question="$question" />
          @break
          @case(2)
          <x-state-change-button to="1" :question="$question" />
          <x-state-change-button to="3" :question="$question" />
          @break
          @case(3)
          <x-state-change-button to="1" :question="$question" />
          @break
          @endswitch
      </tr>
    </tbody>

    @foreach($question->answers as $answer)
    <tbody>
      <tr class="d-flex">
        <th class="col-3">
          {{$answer->users->name}}
        </th>
      </tr>
      <tr class="d-flex">
        <th class="col-3">対応日時</th>
        <td class="col-3">{{$answer->date}}</td>
      </tr>
      <tr class="d-flex">
        <th class="col-3">送信メッセージ</th>
        <td class="col-10text-left">
          {{$answer->message}}
        </td>
      </tr>
      <tr class="d-flex">
        <th class="col-3">コメント</th>
        <td class="col-10 text-left" style="overflow-wrap:break-word">
          {{$answer->comment}}
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>
@endsection


@section('footer')
@if($question->end==2&&$question->staffs_id==Auth::id())
<footer class="footer">

  <div id="dummyForm" class="container" style="display:{{count($errors) > 0||isset($open)?'none':'block'}};">
    <input class=" form-control" type="text" placeholder="対応する" dusk="dummyFormButton">
  </div>
  <div id="form" class="container" style="display:{{count($errors) > 0||isset($open)?'block':'none'}};">
    <div id="handle">三</div>
    <form method="post" action="answerConfirmation">
      @csrf
      <textarea name="message" id="message" class="form-control" type="text" placeholder="メッセージ" autofocus>{{
        old('message')
      }}</textarea>
      <textarea name="comment" id="comment" class="form-control" type="text" placeholder="コメント">{{
        old('comment')
      }}</textarea>
      <div class="buttonwrapper">
        <button class="button-dark" type="submit" dusk="submitButton">送信する</button>
      </div>
    </form>
  </div>
</footer>

@endif
@endsection