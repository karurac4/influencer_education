@extends('layouts.app')

@section('title', '新規会員登録画面')

@section('content')

    <button type="submit" class="register" onclick="location.href='{{ route('login') }}'">ログインはこちら</button>


 <form method="POST" action="{{ route('create') }}">
     @csrf
        <div class="header">
            <p>新規会員登録</p>
        </div>

        <div class="login_info">
            <p>ユーザーネーム</p>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="login_info">
            <p>カナ</p>
            <input id="name_kana" type="text" class="form-control @error('name_kana') is-invalid @enderror" name="name_kana" value="{{ old('name_kana') }}" required autocomplete="name_kana">
                @error('name_kana')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="login_info">
            <p>メールアドレス</p>
                <input id="email" type="text" class="form-control @error('password') is-invalid @enderror" name="email" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <div class="login_info">
            <p>パスワード</p>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <div class="login_info">
            <p>パスワード確認</p>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>

        <button type="submit" class="login">登録</button>

@endsection