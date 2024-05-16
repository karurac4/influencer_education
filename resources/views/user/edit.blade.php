@extends('layouts.user')

@section('content')
    <a href="/">戻る</a>

    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @isset ($user->profile_image)
        <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" alt="プロフィール画像" width="150">
    @else
        <img src="{{ asset('storage/images/no_image.png') }}" alt="ノーイメージ" width="150">
    @endif

        <div class="form-group">
            <label for="profile_image">画像ファイルを選択:</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image">
        </div>

        <div class="form-group">
            <label for="name">ユーザーネーム:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="name_kana">ユーザーネームカナ:</label>
            <input type="text" class="form-control" id="name_kana" name="name_kana" value="{{ $user->name_kana }}" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <a href="{{ route('password.change') }}" class="btn btn-primary">パスワードを変更する</a>
        </div>

        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection