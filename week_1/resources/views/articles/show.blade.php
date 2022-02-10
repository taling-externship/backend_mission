@extends('layout')

@section('content')
    <x-header />

    <section class="main">
        {{ $article->body }}
    </section>
@endsection
