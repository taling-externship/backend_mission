<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold bg-blue-500">
                Install Tailwind CSS 3 In
                <span class="text-red-600">
                    Laravel
                </span>
            </h1>

            <p>
                @foreach ($myData as $value)
                    <a>{{ $value }}</a>
                @endforeach
            </p>
        </div>
    </body>

</html>