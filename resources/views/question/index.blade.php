@extends('layouts.app')
@section('content')

<h1>お問い合わせページ</h1>
<div class="container">
<body>
<form action="{{action('QuestionsController@confirm')}}" method="post">
<!--ゲストの問い合わせフォーム -->
<label>氏名</label><br>
<input type="text" name="name"><br>

<label>メールアドレス</label><br>
<input type="text" name="mail"><br>

<label>電話番号</label><br>
<input type="text" name="tel"><br>

<label>製品種別</label><br>
<select  name="products_id">
@foreach($products as $product)
<option value="{{$product->id}}">{{$product->name}}</option>
@endforeach
</select><br>

<label>お問い合わせ内容</label><br>
<textarea name="content" cols="50" rows="5" ></textarea>
</div>

<div class="form-group text-center"> 
    <button type="submit" class="button">
    　送信する
    </button> 
</div>

</form>
</body>
@endsection