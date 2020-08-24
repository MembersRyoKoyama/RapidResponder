@extends('layouts.guest')
@section('content')



<div class="container sendquestion">

    @if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <div>
            <ul>
                @foreach ($errors as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <form action="{{route('questionConfirm')}}" method="post" class="form">
        @csrf
        <!--ゲストの問い合わせフォーム -->
        <label>氏名　<span>※入力必須</span></label><br>
        <input placeholder="16文字まで" type="text" name="name" value="{{old('name')}}" class="name"><br>

        <label>メールアドレス　※入力必須</label><br>
        <input placeholder="英数字記号のみ" type="text" name="mail" value="{{old('mail')}}" class="name"><br>

        <label>電話番号　※入力必須</label><br>
        <input placeholder="数字のみ　12桁まで" type="text" name="tel" value="{{old('tel')}}" class="name"><br>

        <label>製品種別　※入力必須</label><br>
        <select name="products_id">
            <option value="{{null}}" class="products">選択してください</option>
            @foreach($products as $product)
            <option value="{{$product->id}}" @if(old('products_id')==$product->id ) selected @endif>{{$product->name}}</option>
            @endforeach
        </select><br><br>



        <label>状態タグ　※選択必須</label><br>
        <select name="tags[]" size="5" multiple>
            @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select><br><br>

        <!-- multiple size="5"すると消える 名前を配列化してもダメ size="5" multiple-->

        <label>お問い合わせ内容　※入力必須</label><br>
        <textarea placeholder="2000文字まで" name="content" cols="50" rows="5" value="{{old('content')}}" class="name">{{old('content')}}</textarea>

        <div class="form-group ">
            <button name="confirm-btn" type="submit" class="btn btn-primary">
                確認する
            </button>
        </div>


    </form>

</div>
@endsection