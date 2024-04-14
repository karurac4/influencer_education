@extends('layouts.user')

@section('content')
    <a href="{{ route('user.edit') }}">戻る</a>
    <div class="container">
        <h3>パスワード変更</h3> 
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="form-group">
                    <label for="current_password">{{ __('旧パスワード') }}</label>
                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">{{ __('新パスワード') }}</label>
                    <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">{{ __('新パスワード確認') }}</label>
                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('登録') }}
                </button>
            </form>
        </div>
    </div>
@endsection