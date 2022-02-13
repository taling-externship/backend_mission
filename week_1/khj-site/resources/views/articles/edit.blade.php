@extends('layout')

@section('title', '게시글 수정')

@section('content')

<div class="py-5 bg-light">
    <div class="container mt-4 t-min-h-[750px]">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col-lg-12 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body py-5 px-4">
                        <div class="py-5 text-center">
                            <i class="fa fa-pen fa-3x"></i>
                            <div class="t-text-2xl mt-2">게시글 수정</div>
                            <small class="text-muted"></small>
                        </div>

                        <form method="POST" action="{{ route('articles.update', $article) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            @include('articles.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
