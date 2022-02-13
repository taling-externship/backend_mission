@extends('layout.default')
@section('content')
    <div class="w-full max-w-screen-lg shadow rounded p-8">
        <p class="text-3xl font-bold leading-7 text-center">글 수정</p>
        <form action="{{ route('boards.update')  }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $board->id  }}"/>
            <div class="md:flex items-center mt-8">
                <div class="w-full flex flex-col @error('title') has-danger @enderror">
                    <label class="font-semibold leading-none">제목</label>
                    <input type="text"
                           name="title"
                           value="{{ $board->title }}"
                           class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                </div>
            </div>
            @error('title')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                {{ $message }}
            </div>
            @enderror
            <div>
                <div class="w-full flex flex-col mt-8 @error('body') has-danger @enderror">
                    <label class="font-semibold leading-none">내용</label>
                    <textarea type="text"
                              name="body"
                              class="h-40 text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">{!! $board->body !!}</textarea>
                </div>
            </div>
            @error('body')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                {{ $message }}
            </div>
            @enderror
            <div class="flex items-center justify-center w-full">
                <button
                    type="submit"
                    class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                    수정 완료
                </button>
            </div>
        </form>
    </div>
@stop
