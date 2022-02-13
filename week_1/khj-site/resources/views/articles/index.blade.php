@extends('layout')

@section('title', '게시글')

@section('content')
<div class="t-bg-zinc-300 t-h-[300px]">

</div>
<div class="pt-2 pb-3 bg-light t-min-h-[800px]">
    <div class="container">
        <div class="g-3">
            <a class="btn btn-sm btn-primary mb-3" href="{{ route('articles.create') }}">
                <i class="fas fa-edit"></i>
                게시글 작성
            </a>
        </div>
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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($articles as $article)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body" >
                            <div class="t-text-xs text-muted">No. {{ $article->id }}</div>
                            <div class="card-text" ><a href="{{ route('articles.show', $article) }}">{{ Str::limit($article->title, 35, $end=' ...') }}</a></div>
                            <div class="t-text-xs text-muted mt-2" ><a href="{{ route('articles.show', $article) }}">{{ Str::limit($article->body, 150, $end=' ...') }}</a></div>
                            <div class="text-end align-items-end mt-4">
                                <div class="t-text-xs text-muted">{{ $article->updated_at->timezone('Asia/Seoul')->format('Y-m-d H:i')  }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

<style>
    .search {
        width: 100%;
        margin-bottom: auto;
        margin-top: 50px;
        height: 60px;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px
    }

    .search-input {
        color: white;
        border: 0;
        outline: 0;
        background: none;
        width: 0;
        margin-top: 12px;
        caret-color: transparent;
        line-height: 20px;
        transition: width 0.4s linear
    }

    .search .search-input {
        padding: 0 10px;
        width: 100%;
        caret-color: #536bf6;
        font-size: 19px;
        font-weight: 300;
        color: black;
        transition: width 0.4s linear
    }

    .search-icon {
        height: 34px;
        width: 34px;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        background-color: #536bf6;
        font-size: 10px;
        bottom: 30px;
        position: relative;
        border-radius: 5px
    }

    .search-icon:hover {
        color: #fff !important
    }
</style>
