@extends('layout')

@section('title', '게시글 상세보기')

@section('content')

<div class="py-5 bg-light ">
    <div class="container mt-4 t-min-h-[750px]">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col-lg-12 col-md-8">
                <div class="col-12">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ Session::get('status')[0]}} alert-dismissible fade show d-flex t-justify-between" role="alert">
                            {{ Session::get('status')[1] }}
                            <div class="text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card shadow-sm">
                    <div class="card-header py-4">
                        <div>{{ $article->title }}</div>
                        <div class="t-text-sm text-muted text-end">{{ $article->updated_at->timezone('Asia/Seoul')->format('Y-m-d H:i') }}</div>
                    </div>

                    <div class="card-body py-5 px-4 t-min-h-[500px]">
                        <div>{{ $article->body }}</div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-sm btn-primary" href="{{ route('articles.index') }}">목록으로</a>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('articles.edit', $article) }}">
                                    <i class="fas fa-edit"></i>
                                    수정
                                </a>
                                <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                        <i class="fa fa-trash"></i>
                                        삭제
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
