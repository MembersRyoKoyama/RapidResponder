@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/questionList.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container questionList">
  <h1 class="text-center">お問い合わせ一覧</h1>
  @include('answers.pagingButton',['pages'=>$pages,'now'=>$now,'end'=>$end])
  <div class="dropdown">
    <button type="button" id="dropdown1" class="endMenu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <x-end-icon :end="$end" />
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdown1">
      @for($i=1;$i<=3;++$i) @if($i!=$end) <a class="dropdown-item" href="{{url()->current().'?'.http_build_query(['end'=>$i])}}">
        <x-end-icon end="{{$i}}" />
        </a>
        @endif
        @endfor
    </div>
  </div>
  <table class="questionListTable table table-sm table-striped ">
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
    <tbody>
      <tr></tr>
      @foreach($questions as $question)
      <x-list-item :question="$question" />
      @endforeach
    <tbody>
  </table>
  @include('answers.pagingButton',['pages'=>$pages,'now'=>$now,'end'=>$end])
</div>
@endsection