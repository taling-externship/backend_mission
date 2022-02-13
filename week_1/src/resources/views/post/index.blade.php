@extends('layouts.master')
@section('content')
    <div class="container mx-auto px-4 sm:px-8 max-w-12xl">
        <div class="py-8">
            <button class="bg-blue-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow" onclick="location.href='{{ route('post.create') }}'">Create</button>
            <form method="get" action="{{ route('post.index') }}">
            <div class="flex items-center justify-center ">
                <div class="flex border-2 border-gray-200 rounded">
                    <input type="text" name="searchWord" class="px-4 py-2 w-80" placeholder="Search...(title, notes)" value="{{ $searchWord ?? '' }}">
                    <button class="px-4 text-white bg-gray-600 border-l ">
                        Search
                    </button>
                </div>
            </div>
            </form>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                no
                            </th>
                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                title
                            </th>
                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                notes
                            </th>
                            <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                created_at
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr onclick="location.href='{{ route('post.edit', $post->id) }}'" class="cursor-pointer">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$post->id}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$post->title}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$post->notes}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$post->created_at}}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if(property_exists($posts, 'lastPage') && $posts->lastPage()  > 1)
                        @if($posts->lastPage() > 1)
                            <div class="px-5 bg-white py-5 flex flex-col xs:flex-row items-center xs:justify-between">
                                <div class="flex items-center">
                                    <a href="{{ $posts->appends($_GET)->url(1) }}">
{{--                                    <a href="{{ $posts->appends($_GET)->previousPageUrl() }}">--}}
                                    <button type="button" class="w-full p-4 border text-base rounded-l-xl text-gray-600 bg-white hover:bg-gray-100">
                                        <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z">
                                            </path>
                                        </svg>
                                    </button>
                                    </a>
                                    @for ($i = $j = max($posts->currentPage()-4, 1); $i <= min($posts->lastPage(), $j+9); $i++)
                                        <a href="{{ $posts->appends($_GET)->url($i) }}">
                                        <button type="button" class="w-full px-4 py-2 border-t border-b text-base {{($posts->currentPage() === $i) ? 'text-indigo-500' : ''}} bg-white hover:bg-gray-100 ">
                                            {!! $i !!}
                                        </button>
                                        </a>
                                    @endfor
                                    <a href="{{ $posts->appends($_GET)->url($posts->lastPage()) }}">
{{--                                    <a href="{{ $posts->appends($_GET)->nextPageUrl() }}">--}}
                                    <button type="button" class="w-full p-4 border-t border-b border-r text-base  rounded-r-xl text-gray-600 bg-white hover:bg-gray-100">
                                        <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                                            </path>
                                        </svg>
                                    </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
@endsection
