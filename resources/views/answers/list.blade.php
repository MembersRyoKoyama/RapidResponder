@extends('layouts.app')

@section('content')
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
        <td>詳細</td>
      </tr>
    </tbody>
    @for($i = 0; $i < 10; $i++)
      @include('answers.listitem',['obj'=>$i])
    @endfor
  </table>
</div>
@endsection
