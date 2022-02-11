@extends('layout')

@section('content')
    <x-header />

    <section class="main">
        <h2 class="text-2xl my-4"> {{ $article->title }} </h2>
        <article>
            {{ $article->body }}
        </article>
        <p class="mt-4"> {{ $article->created_at }} </p>
    </section>

    <section class="tags my-4 text-right">
        @foreach ($article->tags as $tag)
            <x-articles.tag>{{ $tag->name }}</x-articles.tag>
        @endforeach
    </section>

    <section class="control mt-4 flex gap-2">
        <x-forms.anchor href="{{ route('article.index') }}" name="back to list" color="red" />
        <x-forms.anchor href="{{ route('article.edit', $article->id) }}" name="edit" color="blue" />
    </section>
@endsection
