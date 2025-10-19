<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FashionablyLate</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--  画面ごとのCSSは各viewで定義 -->
    @yield('css')
</head>
<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>

        {{-- registerページの時はLoginボタンを表示 --}}
        @if (Request::is('register'))
            <a href="{{ route('login') }}" class="header-btn">login</a>
        @elseif (Request::is('login'))
            {{-- loginページの時はregisterボタンを表示 --}}
            <a href="{{ route('register') }}" class="header-btn">register</a>
        @elseif (Request::is('admin'))
            {{-- adminページの時はlogoutボタンを表示 --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="header-btn">logout</button>
            </form>
        @endif
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
