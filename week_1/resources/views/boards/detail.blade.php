@extends('layout.default')
@section('content')
    <div class="bg-white rounded-lg shadow-xl border p-8 w-3xl">
        <div class="mb-4">
            <h1 class="font-semibold text-gray-800">{{ $board->title }}</h1>
        </div>
        <div class="flex justify-center items-center">
            <div>
                <div>
                    <span class="text-gray-800">{!! $board->body !!}</span>
                </div>
                <div class="font-semibold">
                    <a href="{{ route('boards') }}" class="text-blue-600 mr-2">목록으로</a>
                    <a href="" class="text-gray-400">다음 글</a>
                </div>
            </div>
        </div>
    </div>

@stop
