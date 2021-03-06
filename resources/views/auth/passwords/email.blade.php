@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="mess">
                    <p>パスワードを忘れた方はメールアドレスを入力してください<br>
                        入力したアドレスにメッセージが届きます。
                    </p>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        <!--action="{{ route('password.email') }}"  action="/password/reset/end" -->
                        @csrf

                        <div class="">
                            <?php /*form-group row*/ ?>
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label><br>
                            <?php /*col-md-4 col-form-label text-md-right*/ ?>
                            <div class="col-md-6">
                                <input dusk="email" id="email" type="email" class="email mail form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="email-btn" dusk="email-btn" type="submit" class="email-btn submit btn btn-primary" name="email-btn">
                                    {{ __('送信') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection