@extends('layouts.app')

@section('title', 'トップ画面')

@section('content')

    <div class="header-list">
        <ul>
          <label><li><button type="submit" class="schedule">時間割</button></li></label>
          <label><li><button type="submit" class="curriculum">授業進捗</button></li></label>
          <label><li><button type="submit" class="profile">プロフィール設定</button></li></label>
        </ul>

          <div class="header-logo">
            @if (Auth::check())
                <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">ログアウト</a></li>
            @else
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link">ログイン</a></li>
            @endif
          </div>

     </div>



    @foreach($images as $image)
          <img id="image-{{ $image->id }}" class="banner" src="{{ asset('storage/images/' . ($image->image)) }}" >
              <div id="image">
                <button class="my-button" onclick="showImage('{{ $image->id }}')"></button>
              </div>
    @endforeach

     <p class="information">お知らせ</p>


    <div class="info">
      @foreach ($articles as $article)
        <tr>
          <label>
            <button class="date">  <a href="#">
                {{ Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }} {{ $article->title }} {{ $article->article_contents }}
            </button>
          </label><br>
        </tr>
      @endforeach
    </div>

    @endsection