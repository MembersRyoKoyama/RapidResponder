@extends('layouts.app')

@section('content')
<div class="container" id="questionViewTable">
  <h1 class="text-center">お問い合わせ詳細</h1>
  <table class="table table-sm table-borderless text-center">
    <tbody>
      <tr class="d-flex">
        <th class="col-3 h3">{{$question->name}}</th>
        <td class="col-5 text-right">状態</td>
        <td class="col-2">
          @include('answers.endIcon',['end'=>$question->end])
        </td>
        @switch($question->end)
        @case(1)
        <td class="col-2">
          @include('answers.stateChangeButton',['question'=>$question,'to'=>2])
        </td>
        @break
        @case(2)
        <td class="col-2">
          @include('answers.stateChangeButton',['question'=>$question,'to'=>3])
        </td>
        @break
        @case(3)
        <td class="col-2">
          @include('answers.stateChangeButton',['question'=>$question,'to'=>1])
        </td>
        @break
        @endswitch
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <th class="col-3">お問い合わせ日時</th>
        <td class="col-3">{{$question->date}}</td>
        <td class="col-2"></td>
        @switch($question->end)
        @case(1)
        @break
        @case(2)
        <td class="col-2">
          {{$question->users==null?'名無し':$question->users->name}}
        </td>
        <td class="col-2">
          @include('answers.stateChangeButton',['question'=>$question,'to'=>1])
        </td>
        @break
        @case(3)
        <td class="col-2">
          {{$question->users==null?'名無し':$question->users->name}}
        </td>
        @break
        @endswitch
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <th class="col-3">電話番号</th>
        <td class="col-3">{{$question->tel}}</td>
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <th class="col-3">製品番号</th>
        <td class="col-3">{{$question->products->name}}</td>
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <th class="col-3">お問い合わせ内容</th>
        <td class="col-9"></td>
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <td class="text-left">{{$question->content}}</td>
      </tr>
    </tbody>
    @foreach($question->answers as $answer)
    <tbody>
      <tr class="d-flex">
        <th class="col-3">
          {{$answer->users->name}}
        </th>
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <th class="col-3">対応日時</th>
        <td class="col-3">{{$answer->date}}</td>
      </tr>
    </tbody>
    <tbody>
      <tr class="d-flex">
        <th class="col-3">送信メッセージ</th>
        <td class="col-10text-left">
          {{$answer->message}}
        </td>
      </tr>
    </tbody>
    <tbody>
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
    <input class=" form-control" type="text" placeholder="対応する">
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
      <button class="btn btn-primary" type="submit">送信する</button>
    </form>
  </div>
</footer>

@endif
@endsection