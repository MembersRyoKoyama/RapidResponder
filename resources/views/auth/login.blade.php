@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="title">{{ __('ログイン') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="">
                            <?php /*form-group row*/ ?>
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label><br>
                            <?php /*col-md-4 col-form-label text-md-right*/ ?>
                            <div class="col-md-6">
                                <input id="email" type="email" class="mail form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <label for="password" class="pass col-md-4 col-form-label text-md-right">{{ ('パスワード') }}</label><br>

                            <div class="col-md-6">
                                <input id="password" type="password" class="passtext form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="boxform-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="auto form-check-label" for="remember">
                                        {{ __('次回から自動でログインする') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button name="login-btn" type="submit" class="btn btn-primary login">
                                    {{ __('ログインする') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="forget btn btn-link" href="{{ route('password.request') }}" name="password-forget">
                                    {{ __('パスワードを忘れた方はこちら') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection