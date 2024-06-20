@extends('layouts.user')

@section('content')
<div class="container">
    <a href="/">戻る</a>
    
    <div>
    @isset ($user->profile_image)
        <img src="{{ asset('storage/profiles/' . $user->profile_image) }}" alt="プロフィール画像" width="150">
    @else
        <img src="{{ asset('storage/images/no_image.png') }}" alt="ノーイメージ" width="150">
    @endif
    </div>

    
    <h1>{{ $userName }}の授業進捗</h1>
    
    <p>現在の学年：{{ $gradeName }}</p>

    <h2>各学年毎の授業タイトル</h2>
    <ul  class="row row-cols-3">
        @foreach ($grades as $grade)
            <li>
            
            {{ $grade->name }}
            
                <ul>
                @foreach ($curriculums as $curriculum)
                @php
                        $progress = App\Models\CurriculumProgress::where('curriculums_id', $curriculum->id)->first();
                        @endphp
                        <li>
                    @if($grade->id === $curriculum->grades_id)
                    @if($user->grades_id >= $grade->id)
                    <a href="/">{{ $curriculum->title }}</a>
                    
                    @if ($progress && $progress->clear_flag === 1)
                    <a href="/">（受講済）</a>
                    @endif
                    @else 
                        {{ $curriculum->title }}
                    
            @endif
            @endif
            
            </li>
            @endforeach
        </ul>
        </li>
        @endforeach
        
    </ul>
</div>
@endsection
    
