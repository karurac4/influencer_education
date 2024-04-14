@extends('layouts.user')

@section('content')
    <a href="/">戻る</a>
    
    @isset ($user->profile_image)
        <img src="{{ asset('storage/profiles' . $user->profile_image) }}" alt="プロフィール画像">
    @else
        <img src="{{ asset('storage/images/no_image.png') }}" alt="ノーイメージ">
    @endif

    
    <h1>{{ $user->name }}の授業進捗</h1>
    
    <p>現在の学年：{{ $grades->name }}</p>

    <h2>各学年毎の授業タイトル</h2>
    <ul>
        @foreach ($grades as $grade)
            <li>{{ $grades->name }}
                <ul>
                    @foreach ($curriculums as $curriculum)
                        @php
                        $progress = App\Models\CurriculumProgress::where('users_id', $user->id)
                            ->where('curriculums_id', $curriculums->id)->first();
                        @endphp
                        <li>
                            @if ($progress && $progress->clear_flag === 1)
                                {{ $curriculums->title }}（受講済）
                            @else
                                {{ $curriculums->title }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endsection