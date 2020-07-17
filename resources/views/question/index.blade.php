@extends('layouts.guest')
@section('content')

<div class="container sendquestion">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{action('QuestionsController@confirm')}}" method="post" class="form">
        @csrf
        <!--ゲストの問い合わせフォーム -->
        <label>氏名</label><br>
        <input type="text" name="name" value="{{old('name')}}" class="name"><br>

        <label>メールアドレス</label><br>
        <input type="text" name="mail" value="{{old('mail')}}" class="name"><br>

        <label>電話番号</label><br>
        <input type="text" name="tel" value="{{old('tel')}}" class="name"><br>

        <label>製品種別</label><br>
        <select name="products_id">
            <option value="{{null}}" class="products">選択してください</option>
            @foreach($products as $product)
            <option value="{{$product->id}}" @if(old('products_id')==$product->id ) selected @endif>{{$product->name}}</option>
            @endforeach
        </select><br>

        <label>お問い合わせ内容</label><br>
        <textarea name="content" cols="50" rows="5" value="{{old('content')}}" class="name">{{old('content')}}</textarea>

        <div class="form-group ">
            <button type="submit" class="btn btn-primary">
                確認する
            </button>
        </div>

    </form>

</div>
@endsection