@extends('layouts.app')

@section('title', 'ログイン画面')

@section('content')



<button type="button" class="register" onclick="location.href='{{ route('register') }}'">新規会員登録はこちら</button>

 <form method="POST" action="{{ route('login') }}">
 @csrf

    <div class="header">
        <p>ログイン</p>
    </div>

    <div class="login_info">
        <p>メールアドレス</p>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
    </div>


    <div class="login_info">
        <p>パスワード</p>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
    </div>


<button type="submit" class="login">ログイン</button>

</form>