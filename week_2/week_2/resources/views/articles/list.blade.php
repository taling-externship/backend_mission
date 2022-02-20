@extends('app')

@section('title', '게시물 리스트')

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="t-flex">
                <h1 class="t-font-bold t-mr-auto">게시물 리스트</h1>
                <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">글 작성</a>
            </div>
            <ul class="t-grid t-grid-cols-1 sm:t-grid-cols-2 lg:t-grid-cols-3 t-gap-4 t-mt-4">
                @foreach ($articles as $article)
                    <li>
                        <div class="card">
                            <a href="{{ route('articles.show', $article->id) }}" class="t-block">
                                <img src="{{ $article->thumb_img_url }}" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <div class="t-grid t-gap-4">
                                    <div class="t-flex t-gap-4 t-flex-wrap">
                                        <a href="{{ route('articles.show', $article->id) }}">
                                            <span class="badge bg-primary">No. {{ $article->id }}</span>
                                        </a>
                                        <a href="{{ route('articles.show', $article->id) }}" class="t-mr-auto">
                                            <span class="badge bg-secondary">
                                                Date. {{ $article->created_at->format('y.m.d H:i') }}
                                            </span>
                                        </a>
                                        <a href="{{ route('articles.show', $article->id) }}">
                                            <span class="badge bg-success">
                                                by {{ $article->user->name }}
                                            </span>
                                        </a>
                                    </div>

                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="t-block card-title t-truncate">{{ $article->title }}</a>

                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="t-block card-text t-text-gray-500">
                                        <div class="multiline-truncate-3">
                                            {{ $article->body }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
