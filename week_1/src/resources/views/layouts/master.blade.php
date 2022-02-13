<!DOCTYPE HTML>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, width=device-width, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">
    <title>week_1</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    @yield('before-style')
{{--    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">--}}
    @yield('before-style')
</head>
<body>
<div id="wrapper">
    <div id="container">
        <div id="content">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
@yield('script')
</body>
</html>
