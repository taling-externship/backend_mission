@extends('layout')

@section('content')
    <x-header />

    <section class="my-4">
        <ul>
        @forelse ($articles as $article)
            <x-articles.item>
                <a href="{{ route('article.show', $article->id) }}">
                    {{ $article->title }}
                </a>
                <span class="text-xs">{{ $article->created_at->diffForHumans() }}</span>
                <p class="text-right mt-2">
                    @foreach ($article->tags as $tag)
                        <span class="text-xs text-white bg-blue-400 rounded p-1">{{ $tag->name }}</span>
                    @endforeach
                </p>
            </x-articles.item>
        @empty
            <p>No articles yet...</p>
        @endforelse
        </ul>
    </section>

    <section class="pagination">
        {{ $articles->links() }}
    </section>

    <section class="control my-4">
        <x-forms.anchor
            href="{{ route('article.create') }}"
            color="blue"
            name="make new" />
    </section>

@endsection
