@extends('app')

@section('title', '게시물 상세내용')

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="t-grid t-grid-cols-1 t-gap-4">

                <div class="t-flex t-gap-4 t-flex-wrap">
                    <div>
                        <span class="badge bg-primary">No. {{ $board->id }}</span>
                    </div>
                    <div class="t-mr-auto">
                        <span class="badge bg-secondary">
                            Date. {{ $board->created_at->format('y.m.d H:i') }}
                        </span>
                    </div>
                    <div>
                        <span class="badge bg-success">
                            by {{ $board->user->name }}
                        </span>
                    </div>
                </div>

                <div class="t-font-bold t-text-lg">
                    {{ $board->title }}
                </div>

                @if ($board->img)
                    <div>
                        <img src="{{ asset('storage/' . $board->img) }}" alt="{{ $board->title }}"
                            class="t-rounded">
                    </div>
                @endif

                <div class="t-text-gray-500">
                    {{ nl2br($board->body) }}
                </div>

                <div class="t-flex t-gap-4">
                    <a href="{{ route('boards.edit', $board->id) }}" href="#" class="btn btn-outline-secondary">수정</a>

                    <form class="t-m-0" action="{{ route('boards.destroy', $board->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="if ( !confirm('정말 삭제하시겠습니까?') ) return false;"
                            class="btn btn-outline-danger">삭제</button>
                    </form>
                    <a href="{{ route('boards.index') }}" class="btn btn-link t-m1-auto">리스트</a>
                    <a href="{{ route('boards.create') }}" class="btn btn-link">작성</a>
                </div>
            </div>
        </div>
    </section>
@endsection
