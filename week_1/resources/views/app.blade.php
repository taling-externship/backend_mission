<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>

<body class="t-flex t-flex-col t-min-h-screen">
    <header class="t-top-bar t-fixed t-top-0 t-left-0 t-w-full t-z-50 t-h-10 t-shadow t-text-gray-500 t-bg-white t-pr-2">
        <div class="t-container t-mx-auto t-h-full t-flex">
            <a href="{{ route('home') }}" class="t-flex t-items-center t-px-4">
                <i class="fab fa-instagram"></i>
                <span class="t-hidden sm:t-block">&nbsp;</span>
                <span class="t-hidden sm:t-block t-pt-1">인스타그램</span>
            </a>
            <div class="t-flex-grow">
                {{-- <form action="{{ route('boards.search'), request()->query }}" method="GET"
                    class="t-flex t-items-center">
                    @csrf

                    <div class="input-group">
                        <div class="form-outline">
                            <input type="search" class="form-control" name="query" />
                        </div>
                        <button class="btn btn-primary t-mr-auto"><i class="fas fa-search"></i></button>
                    </div>
                </form> --}}
            </div>
            <nav class="menu-1">
                <ul class="t-flex t-h-full">
                    <li class="{{ Route::currentRouteName() == 'home' ? 't-text-[#ff4545]' : '' }}">
                        <a href="{{ route('home') }}" class="t-h-full t-flex t-items-center px-2">
                            <i class="fas fa-solid fa-home"></i>
                            <span class="t-hidden sm:t-block">&nbsp;</span>
                            <span class="t-hidden sm:t-block t-pt-1">홈</span>
                        </a>
                    </li>
                    <li class="{{ Str::startsWith(Route::currentRouteName(), 'boards.') ? 't-text-[#ff4545]' : '' }}">
                        <a href="{{ route('boards.index') }}" class="t-h-full t-flex t-items-center px-2">
                            <i class="far fa-plus-square"></i>
                            <span class="t-hidden sm:t-block">&nbsp;</span>
                            <span class="t-hidden sm:t-block t-pt-1">게시물</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="t-h-full t-flex t-items-center px-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="t-hidden sm:t-block">&nbsp;</span>
                            <span class="t-hidden sm:t-block t-pt-1">로그아웃</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="t-h-full t-flex t-items-center px-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span class="t-hidden sm:t-block">&nbsp;</span>
                            <span class="t-hidden sm:t-block t-pt-1">로그인</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- 상단바의 높이만큼 -->
    <div class="t-h-10"></div>

    @include('flash-message')

    <main class="t-flex-grow t-flex t-flex-col">
        @yield('content')
    </main>
</body>

</html>
