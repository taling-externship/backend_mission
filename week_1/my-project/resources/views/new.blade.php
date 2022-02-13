@extends("layouts.app")

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
  <body>
    <div class="container">
      @section('header')
        <h1 class="text-2xl font-bold">
          새로운 포스트 작성
        </h1>
      @endsection

      @section('slot')
      <form method="POST" action="/post/new">
        @csrf

        <label class="mr-3" for="">
          내용
        </label>
        <input name="post-body" type="text">

        <button class="p-2 bg-gray-400" type="submit">
          제출하기
        </button>
      </form>
      @endsection
    </div>
  </body>
</html>
