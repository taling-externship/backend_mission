<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="t-w-[300px] t-h-[500px] t-bg-[#afff00]"></div>
    <button class="btn btn-primary" href="/user">버튼</button>

    <div class="t-container t-mx-auto">
        @foreach($users as $user)
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque distinctio hic excepturi illo, iure doloribus quis, nemo quam animi ratione asperiores, sapiente soluta voluptatem architecto quod nihil magni possimus provident.
        @endforeach

    </div>
</body>
</html>