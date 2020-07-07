@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-center">お問い合わせ一覧</h1>
  @include('answers.pagingButton',['pages'=>$pages,'now'=>$now,'end'=>$end])
  <div class="dropdown">
    <button type="button" id="dropdown1" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      @include('answers.endIcon',['end'=>$end])
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdown1">
      @for($i=1;$i<=3;++$i) @if($i!=$end) <a class="dropdown-item" href="{{url()->current().'?'.http_build_query(['end'=>$i])}}">
        @include('answers.endIcon',['end'=>$i])
        </a>
        @endif
        @endfor
    </div>
  </div>
  <table class="table table-sm table-bordered">
    <thead>
      <tr class="d-flex">
        <th class="col-1">対応状況</th>
        <th class="col-1">氏名</th>
        <th class="col-2">電話番号</th>
        <th class="col-1">製品種別</th>
        <th class="col-2">日時</th>
        <th class="col-5">お問い合わせ内容</th>
      </tr>
    </thead>
    @foreach($questions as $question)
    @include('answers.listitem',['q'=>$question])
    @endforeach
  </table>
  @include('answers.pagingButton',['pages'=>$pages,'now'=>$now,'end'=>$end])
</div>
@endsection