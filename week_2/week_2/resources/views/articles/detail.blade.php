@extends('app')

@section('title', '게시물 상세내용')

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="t-grid t-grid-cols-1 t-gap-4">

                <div class="t-flex t-gap-4 t-flex-wrap">
                    <div>
                        <span class="badge bg-primary">No. {{ $article->id }}</span>
                    </div>
                    <div class="t-mr-auto">
                        <span class="badge bg-secondary">
                            Date. {{ $article->created_at->format('y.m.d H:i') }}
                        </span>
                    </div>
                    <div>
                        <span class="badge bg-success">
                            by {{ $article->user->name }}
                        </span>
                    </div>
                </div>

                <div class="t-font-bold t-text-lg">
                    {{ $article->title }}
                </div>

                @if ($article->img_1)
                    <div>
                        <img src="{{ asset('storage/' . $article->img_1) }}" alt="{{ $article->title }}"
                            class="t-rounded">
                    </div>
                @endif


                <div class="t-text-gray-500">
                    {{ nl2br($article->body) }}
                </div>

                <div class="t-flex t-gap-4">
                    <a href="{{ route('articles.edit', $article->id) }}" href="#" class="btn btn-link">수정</a>
                    <form class="t-m-0" action="{{ route('articles.destroy', $article->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="if ( !confirm('정말 삭제하시겠습니까?') ) return false;"
                            class="btn btn-outline-danger">삭제</button>
                    </form>
                    <a href="{{ route('articles.index') }}" class="btn btn-link t-ml-auto">리스트</a>
                    <a href="{{ route('articles.create') }}" class="btn btn-link">작성</a>
                </div>
            </div>
        </div>
    </section>
@endsection
