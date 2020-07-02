@extends('layouts.app')

@section('content')
<h1 class="text-center">お問い合わせ一覧</h1>
<div class="container">
  @include('answers.pagingButton',['pages'=>$pages,'now'=>$now,'end'=>$end])
  <div class="dropdown">
    <button type="button" id="dropdown1"
        class="btn btn-secondary dropdown-toggle"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        @include('answers.endIcon',['end'=>$end])
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdown1">
     @for($i=1;$i<=3;++$i)
      @if($i!=$end)
        <a class="dropdown-item" href="{{url()->current().'?'.http_build_query(['end'=>$i])}}">
          @include('answers.endIcon',['end'=>$i])
        </a>
      @endif
     @endfor
    </div>
  </div>
  <table>
    <tbody>
      <tr>
        <td>対応状況</td>
        <td>氏名</td>
        <td>電話番号</td>
        <td>製品種別</td>
        <td>日時</td>
        <td>お問い合わせ内容</td>
        <td></td>
      </tr>
    </tbody>
    @foreach($questions as $question)
      @include('answers.listitem',['q'=>$question])
    @endforeach
  </table>
  @include('answers.pagingButton',['pages'=>$pages,'now'=>$now,'end'=>$end])
</div>
@endsection
