<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<hr class="bg-blue-400 hover:bg-blue-700 hidden" />
<hr class="bg-red-400 hover:bg-red-700 hidden" />

<main class="container mx-auto px-4 my-4 max-w-xl">

    @yield('content')

</main>
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
