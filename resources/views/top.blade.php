@extends('layouts.app')

@section('title', 'トップ画面')

@section('content')

    <div class="header-list">
        <ul>
          <li><button type="submit" class="schedule">時間割</button></li>
          <li><button type="submit" class="curriculum">授業進捗</button></li>
          <li><button type="submit" class="profile">プロフィール設定</button></li>
        </ul>

          <div class="header-logo">

            @if (Auth::check())
                        <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">ログアウト</a></li>
                    @else
                        <li class="nav-item"><a href="{{route('login')}}" class="nav-link">ログイン</a></li>
                    @endif

          </div>
     </div>



    <div class="btnWrapper">
      <button class="btn show" id="btn1">画像1</button>
      <button class="btn" id="btn2">画像2</button>

    </div>
 


    <div class="information">
      <p>お知らせ</p>
    </div>





    <div class="info">
     <div id="notice-container">
      @foreach ($articles as $article)
        <tr>
          <button class="date"><td>{{ Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }} {{ $article->title }}</td></button>
        </tr>
      @endforeach
     </div>
    </div>


    @endsection