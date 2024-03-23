@extends('layouts.app')

@section('title', '授業配信画面')

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

     <div class="back_button">
        <button class="back" onclick="location.href='{{ route('top') }}'">←戻る</button>
    </div>


    <div class="video">
      <img src="video_url" class="movie">

      <button type="submit" class="clear">受講しました</button>




    </div>
    <div class="personal">

      <button class="grade">grade</button>

    <div class="title">
      <p>title</p>
    </div>

    <div class="contents">
      <p>講義内容</p>
    </div>

    <div class="description">
      <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div>
  </div>

  @endsection