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
        <input placeholder="16文字まで" type="text" name="name" value="{{old('name')}}" class="name" id="name"><br>

        <label>メールアドレス　※入力必須</label><br>
        <input placeholder="英数字記号のみ" type="text" name="mail" value="{{old('mail')}}" class="name" id="mail"><br>

        <label>電話番号　※入力必須</label><br>
        <input placeholder="数字のみ　12桁まで" type="text" name="tel" value="{{old('tel')}}" class="name" id="tel"><br>

        <label>製品種別　※入力必須</label><br>
        <select name="products_id">
            <option value="{{null}}" class="products">選択してください</option>
            @foreach($products as $product)
            <option value="{{$product->id}}" @if(old('products_id')==$product->id ) selected @endif>{{$product->name}}</option>
            @endforeach
        </select><br>

        <label>状態タグ　※選択必須・複数選択可
        </label>
        <select id="select_box_list" name="tags[]" size="5" data-selected="{{ old('tags') }}" multiple hidden>
            @foreach($tags as $tag)
            <option data-no="0" value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select><br>

        <div class="content">
            <a class="js-modal-open" href="">クリックでタグを選択</a>
        </div>
        <div class="modal js-modal">
            <div class="modal__bg js-modal-close"></div>
            <div class="modal__content">
                <input type="checkbox" data-no="0" id="step1_0" class=" js-check"> <label for="step1_0"> 初期不良</label><br>
                <input type="checkbox" data-no="1" id="step1_1" class="js-check"><label for="step1_1"> パーツ欠損</label><br>
                <input type="checkbox" data-no="2" id="step1_2" class="js-check"><label for="step1_2"> 故障</label><br>
                <input type="checkbox" data-no="3" id="step1_3" class="js-check"><label for="step1_3"> 老朽化</label><br>
                <input type="checkbox" data-no="4" id="step1_4" class="js-check"><label for="step1_4"> 疑問点・質問</label><br>
                <input type="checkbox" data-no="5" id="step1_5" class="js-check"><label for="step1_5"> その他</label><br>

                <a class="js-modal-close modal-close btn btn-primary" href="">閉じる</a>
            </div>
            <!--modal__inner-->
        </div>
        <!--modal-->

        <!-- multiple size="5"すると消える 名前を配列化してもダメ size="5" multiple-->

        <label>お問い合わせ内容　※入力必須</label><br>
        <textarea placeholder="2000文字まで" name="content" cols="50" rows="5" value="{{old('content')}}" class="name" id="content">{{old('content')}}</textarea>

        <div class="form-group ">
            <button name="confirm-btn" type="submit" class="btn btn-primary">
                確認する
            </button>
        </div>

    </form>

</div>
@endsection