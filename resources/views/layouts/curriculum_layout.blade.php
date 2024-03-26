<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .btn-custom-lightblue {
        color: #fff;
        background-color: #add8e6; 
        border-color: #add8e6; 
        }
    </style>


    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
    <div class="row">
<!-- 左側のメニューバー -->
<div class="col-md-3">
    <h3>学年一覧</h3>
    @foreach($grades as $key => $grade)
        @if($key < 6)
        <a href="#" class="btn btn-custom-lightblue grade-link" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</a><br>
        @elseif($key < 9)
            <a href="#" class="btn btn-success grade-link" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</a><br>
        @else
            <a href="#" class="btn btn-info grade-link" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</a><br>
        @endif
    @endforeach
</div>
        
        <!-- コンテンツ -->
        <div class="col-md-9">
            <main class="py-4">
                @yield('content') <!-- curriculum.blade.php を挿入 -->
            </main>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
$(document).on('click', '.grade-link', function(e) {
    e.preventDefault();
    var gradeId = $(this).data('grade-id');
    
    $.ajax({
        url: '/getCurriculums',
        method: 'GET',
        data: { grade_id: gradeId },
        success: function(response) {
            $('#curriculum-container').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch curriculums:', error);
        }
    });
});
</script>


</body>
</html>
