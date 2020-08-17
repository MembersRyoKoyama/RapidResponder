@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <div class="col-md-8">
            <div class="">
                <div class=""></div>

                <div class="">
                    <form method="POST" action="{{ route('password.update') }}">
                        <?php /*<!--action="{{ route('password.update') }}">-->*/ ?>
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="">
                            {{--<label for="email" class="mail col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label><br>--}}

                            <div class="col-md-6">
                                <input id="email" type="email" class="mailbox form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus hidden>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <label for="password" class="passa col-md-4 col-form-label text-md-right">{{ __('パスワードを入力してください') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="passbox form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <label for="password-confirm" class="confirm  col-form-label text-md-right">{{ ('確認のためもう一度入力して下さい') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="confirmbox form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="change btn btn-primary">
                                    {{ __('変更する') }}
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