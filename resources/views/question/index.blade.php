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

        <label>電話番号</label>　<label>　※入力必須</label><br>
        <input placeholder="数字のみ　12桁まで" type="text" name="tel" value="{{old('tel')}}" class="name"><br>

        <label>製品種別</label><label>　※入力必須</label><br>
        <select name="products_id">
            <option value="{{null}}" class="products">選択してください</option>
            @foreach($products as $product)
            <option value="{{$product->id}}" @if(old('products_id')==$product->id ) selected @endif>{{$product->name}}</option>
            @endforeach
        </select><br>


        <div class="content">
            <a class="js-modal-open" href="">クリックでモーダルを表示</a>
        </div>
        <div class="modal js-modal">
            <div class="modal__bg js-modal-close"></div>
            <div class="modal__content">
                <a class="js-modal-close" href="">閉じる</a>
            </div>
            <!--modal__inner-->
        </div>
        <!--modal-->
        <div class="wrapper">
            <div class="container">
                <div class="dropdown">
                    <select id="tag_id" name="a-block">
                        <option value="">選択してください</option>
                        <option value="a1">“100年に一人の逸材” 棚橋弘至</option>
                        <option value="a2">“暴走キングコング” 真壁刀義</option>
                        <option value="a3">“混沌の荒武者” 後藤洋央紀</option>
                        <option value="a4">“STONE PITBULL” 石井智宏</option>
                        <option value="a5">“HEAD HUNTER” YOSHI-HASHI</option>
                        <option value="a6">“ジ・アンダーボス” バッドラック・ファレ</option>
                        <option value="a7">“制御不能なカリスマ” 内藤哲也</option>
                        <option value="a8">“ブルージャスティス” 永田裕志</option>
                        <option value="a9">“英国の若き匠” ザック・セイバーJr.</option>
                        <option value="a10">“ゴールデン★スター” 飯伏幸太</option>
                    </select>
                </div>
            </div>
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