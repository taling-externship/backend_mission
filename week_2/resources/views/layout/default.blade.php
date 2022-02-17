<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    <header class="flex justify-center">
        @include('layout.header')
    </header>
    <main class="flex justify-center">
        @yield('content')
    </main>
    <footer class="flex justify-center"></footer>
</div>
</body>
</html>
