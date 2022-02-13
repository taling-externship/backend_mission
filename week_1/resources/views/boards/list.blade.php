@extends('app')

@section('title', '게시물리스트')

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="t-flex">
                <h1 class="t-font-bold t-mr-auto">게시물 리스트</h1>
                <a href="{{ route('boards.create') }}" class="btn btn-primary btn-sm">글 작성</a>
            </div>
            <ul class="t-grid t-grid-cols-1 sm:t-grid-cols-2 lg:t-grid-cols-3 t-gap-4 t-mt-4">
                @foreach ($boards as $board)
                    <li>
                        <div class="card">
                            <a href="{{ route('boards.show', $board->id) }}" class="t-block">
                                <img src="{{ $board->thumb_img_url }}" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <div class="t-grid t-gap-4">
                                    <div class="t-flex t-gap-4 t-flex-wrap">
                                        <a href="{{ route('boards.show', $board->id) }}">
                                            <span class="badge bg-primary">No. {{ $board->id }}</span>
                                        </a>
                                        <a href="{{ route('boards.show', $board->id) }}" class="t-mr-auto">
                                            Date. {{ $board->created_at->format('y.m.d H:i') }}
                                        </a>
                                        <a href="{{ route('boards.show', $board->id) }}">
                                            <span class="badge bg-success">
                                                by {{ $board->user->name }}
                                            </span>
                                        </a>
                                    </div>

                                    <a href="{{ route('boards.show', $board->id) }}"
                                        class="t-block card-title t-truncate">{{ $board->title }}</a>

                                    <a href="{{ route('boards.show', $board->id) }}"
                                        class="t-block card-text t-mt-2 t-text-gray-500">
                                        <div class="multiline-truncate-3">
                                            {{ $board->body }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="t-max-w-screen-sm t-max-h-40 ">
                {{ $boards->links() }}
            </div>
        </div>
    </section>
@endsection
