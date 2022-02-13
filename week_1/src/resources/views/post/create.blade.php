@extends('layouts.master')
@section('content')
    <div style="width: 900px;" class="container max-w-full mx-auto pt-4">
        <form method="POST" action="{{ route('post.store') }}">
            @csrf
            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Title: </label>
                <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="title" name="title" value="{{ $post->title ?? '' }}">
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="content">Notes: </label>
                <textarea class="h-16 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="notes" name="notes" >{{ $post->notes ?? '' }}</textarea>
            </div>
            <button class="bg-blue-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">Register</button>
            <a href="{{ route('post.index') }}" class="bg-gray-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">Cancel</a>
        </form>
    </div>
@stop
