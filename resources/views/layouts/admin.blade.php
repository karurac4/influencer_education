<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!--jQuery-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/banner.js') }}"></script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info bg-gradient shadow-sm py-3">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->  
                        <div class="navbar-nav me-auto">
                            <button type="submit" class="btn btn-secondary px-3 py-0 me-2">
                                <a href="{{ route('admin.curriculum') }}" class="text-decoration-none text-white lead">
                                    <h5 class="pt-2">授業管理<h5>
                                </a>
                            </button>
                            <button type="submit" class="btn btn-secondary px-3 py-0 me-2">
                                <a href="{{ route('admin.article') }}" class="text-decoration-none text-white lead">
                                    <h5 class="pt-2">お知らせ管理<h5>
                                </a>
                            </button>
                            <button type="submit" class="btn btn-secondary px-3 py-0 me-2">
                                <a href="{{ route('admin.banner') }}" class="text-decoration-none text-white lead">
                                    <h5 class="pt-2">バナー管理<h5>
                                </a>
                            </button>
                        </div>
                        <div class="navbar-nav ms-auto">
                            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST">
                            @csrf
                                <a class="text-decoration-none text-white lead" 
                                    href="{{ url('admin/logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>