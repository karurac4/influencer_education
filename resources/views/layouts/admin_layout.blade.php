<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- head部分の内容 -->
</head>
<body>

    <div class="container-fluid">
        <div class="row">

            <!-- メニューバー -->
            <div class="col-md-3">
                <h3>メニュー</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('curriculums.index') }}">授業管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="###">お知らせ管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="###">バナー管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="###">ログアウト</a>
                    </li>
                </ul>
            </div>

            <!-- ページのコンテンツ -->
            <div class="col-md-9">
                @yield('content')
            </div>

        </div>
    </div>

</body>
</html>
