@extends('layout')

@section('content')
    <x-header />

    <form action="{{ $method === 'PATCH' ? route('article.update', $article->id) : route('article.store') }}" method="POST">
        @csrf
        @method($method === 'PATCH' ? 'PATCH' : 'POST')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">title</label>
            <x-forms.input id="title" type="text" name="title"
                value="{{ $method === 'PATCH' ? $article->title : null }}" />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">body</label>
            <x-forms.textarea id="body" name="body"
                value="{{ $method === 'PATCH' ? $article->body : null }}" />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">tags</label>
            <div class="flex gap-2">
                <x-forms.input id="tags" type="text" name="tags[]"
                    value="{{ $method === 'PATCH' && isset($article->tags[0]) ? $article->tags[0]->name : null }}" />
                <x-forms.input id="tags" type="text" name="tags[]"
                    value="{{ $method === 'PATCH' && isset($article->tags[1]) ? $article->tags[1]->name : null }}" />
                <x-forms.input id="tags" type="text" name="tags[]"
                    value="{{ $method === 'PATCH' && isset($article->tags[2]) ? $article->tags[2]->name : null }}" />
            </div>
        </div>

        <x-forms.button type="submit" name="submit" color="blue" />
        <x-forms.anchor href="{{ route('article.index') }}" name="cancel" color="red" />
    </form>

@endsection
