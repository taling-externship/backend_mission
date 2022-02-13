@extends('app')

@php
$pageModeHan = $pageMode == 'write' ? '작성' : '수정';
$actionUrl = $pageMode == 'write' ? route('boards.store') : route('boards.update', $board->id);
$formMethod = $pageMode == 'write' ? 'POST' : 'PATCH';
@endphp

@section('title', '게시물 ' . $pageModeHan)

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <h1 class="t-font-bold">게시물 {{ $pageModeHan }}</h1>

            <form class="t-grid t-grid-cols-1 t-gap-4 t-mt-4" action="{{ $actionUrl }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method($formMethod)
                @if ($pageMode == 'edit')
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
                @endif

                <div>
                    <label class="form-label">제목</label>
                    <input name="title" type="text" maxlength="100"
                        class="@error('title') is-invalid @enderror form-control" placeholder="제목을 입력해주세요."
                        value="{{ old('title', $board->title) }}">

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label>내용</label>
                    <textarea name="body" class="@error('body') is-invalid @enderror form-control" rows="10"
                        placeholder="내용을 입력해주세요.">{{ old('body', $board->body) }}</textarea>

                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label>이미지</label>
                    <input type="file" name="img" class="@error('img') is-invalid @enderror form-control">

                    @error('img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="t-flex t-gap-4">
                    <button class="btn btn-primary t-mr-auto">{{ $pageModeHan }}</button>
                    <a href="{{ route('boards.index') }}" class="btn btn-link">리스트</a>

                    @if ($pageMode == 'edit')
                        <a class="t-m-0 btn btn-outline-danger"
                            href="javascript:if ( confirm('정말로 삭제하시겠습니까?') ) document.board_destory_form.submit();">삭제</a>
                    @endif
                </div>
            </form>

            @if ($pageMode == 'edit')
                <form class="t-hidden" name="board_destory_form" action="{{ route('boards.destroy', $board->id) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            @endif
        </div>
    </section>
@endsection
