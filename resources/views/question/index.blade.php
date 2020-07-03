@extends('layouts.app')
@section('content')

<h1>お問い合わせページ</h1>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{action('QuestionsController@confirm')}}" method="post">
        @csrf
        <!--ゲストの問い合わせフォーム -->
        <label>氏名</label><br>
        <input type="text" name="name" value="{{old('name')}}"><br>

        <label>メールアドレス</label><br>
        <input type="text" name="mail"><br>

        <label>電話番号</label><br>
        <input type="text" name="tel"><br>

        <label>製品種別</label><br>
        <select name="products_id">
            <option value="{{null}}">選択してください</option>
            @foreach($products as $product)
            <option value="{{$product->id}}" @if(old('products_id')==$product->id ) selected @endif>{{$product->name}}</option>
            @endforeach
        </select><br>

        <label>お問い合わせ内容</label><br>
        <textarea name="content" cols="50" rows="5"></textarea>


        <div class="form-group text-center">
            <button type="submit" class="button">
                　確認する
            </button>
        </div>

    </form>
</div>

@endsection