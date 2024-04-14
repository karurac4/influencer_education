<!-- 仮のヘッダーを指定 -->
@extends('layouts.admin_layout')

@section('content')
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">戻る</a>

    <h1>お知らせ変更</h1>

    <form action="{{ route('admin.articles.store') }}">
        @csrf

        <div class="form-group">
            <label for="posted_date">投稿日時</label>
            <!-- Carbonオブジェクトに変換 -->
            <input type="datetime-local" name="posted_date" id="posted_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="article_contents">本文</label>
            <textarea name="article_contents" id="article_contents" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@endsection