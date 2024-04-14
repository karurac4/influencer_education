@extends('layouts.user')

@section('content')
    <a href="/">戻る</a>

    <div class="articles-details">
        <p>お知らせ投稿日時: {{ $article->posted_date }}</p>
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->article_contents }}</p>
    </div>
@endsection