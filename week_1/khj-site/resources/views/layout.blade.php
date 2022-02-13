<!doctype html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KHJ - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="https://img.icons8.com/material-rounded/24/000000/flower-doodle.png" />
</head>

<body class="t-flex t-flex-col t-min-h-screen">
<header class="t-top-bar t-fixed t-top-0 t-left-0 t-w-full t-z-50 t-h-10 t-shadow t-text-gray-500 t-bg-white">
    <div class="t-container t-mx-auto t-h-full t-flex">
        <a href="{{ route('home') }}" class="t-flex t-items-center t-pl-0 t-ml-0 t-pr-4">
            <img src="https://img.icons8.com/material-rounded/24/000000/flower-doodle.png"/>
            <span class="t-hidden sm:t-block">&nbsp;</span>
            <span class="t-hidden sm:t-block t-pt-1">KHJ</span>
        </a>
        <div class="t-flex-grow"></div>
        <nav class="menu-1">
            <ul class="t-flex t-h-full">
                <li class="{{ Route::currentRouteName() == 'home' ? 't-text-[#ff4545]' : '' }}">
                    <a href="{{ route('home') }}" class="t-h-full t-flex t-items-center px-2">
                        <i class="fas fa-home"></i>
                        <span class="t-hidden sm:t-block">&nbsp;</span>
                        <span class="t-hidden sm:t-block t-pt-1">홈</span>
                    </a>
                </li>
                <li class="{{ Str::startsWith(Route::currentRouteName(), 'articles.') ? 't-text-[#ff4545]' : '' }}">
                    <a href="{{ route('articles.index') }}" class="t-h-full t-flex t-items-center px-2">
                        <i class="fa fa-align-justify"></i>
                        <span class="t-hidden sm:t-block">&nbsp;</span>
                        <span class="t-hidden sm:t-block t-pt-1">게시물</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="border-bottom">
    @yield('content')
</main>
</body>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4">
        <p class="col-md-4"></p>

        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="https://img.icons8.com/material-rounded/24/000000/flower-doodle.png"/>
        </a>

        <p class="col-md-4"></p>
    </footer>
</div>
</html>
