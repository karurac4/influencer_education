<!-- 仮のヘッダーを設定 -->
@extends('layouts.admin_layout')

@section('content')
    <a href="/" class="btn btn-secondary">戻る</a>

    <h1>お知らせ一覧</h1>
    
    <!-- ここにはcreateアクションのルートを設定する -->
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">新規登録</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>投稿日時</th>
                <th>タイトル</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->posted_date }}</td>
                    <td>{{ $article->title }}</td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary">変更する</a>
                        <!-- <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display: inline;"> -->
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                        
                            @csrf
                            @method('delete')
                            <!-- <button data-article_id="{{$article->id}}" type="submit" class="btn btn-danger">削除</button> -->
                            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection