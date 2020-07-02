@extends('layouts.app')

@section('content')
<h1>お問い合わせ一覧</h1>
<div class="container">
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
</div>
@endsection
