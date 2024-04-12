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


    @foreach($Curriculums as $curriculum)
    @if($curriculum->isWithinDeliveryPeriod)
        <iframe id="video-{{ $curriculum->id }}" class="movie" src="{{ asset($curriculum->video_url) }}"></iframe>
        <form action="{{ route('update.flag') }}" method="POST">
            @csrf
            @if($record)
                <button type="submit" class="clear" name="id" value="{{ $record->id }}">受講しました</button>
            @endif
        </form>
    @else

    <img src="https://img.youtube.com/vi/{{$curriculum->thumbnail}}/maxresdefault.jpg" width="600px" height="400px">


        </div>
    @endif



      <div class="personal">

            <span class="grade">小学校{{$curriculum->grade_id}}年生</span>



            <div class="title">
            <p>授業タイトル <br>{{$curriculum->title}}</p>
        </div>
            <div class="description">
              <p>講座説明 <br>{{$curriculum->description}}</p>
            </div>

      </div>
  @endforeach
  @endsection