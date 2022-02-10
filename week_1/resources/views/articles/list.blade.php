@extends('layout')

@section('content')
    <x-header />

    <ul>
    @forelse ($articles as $article)
        <li>{{ $article->title }}</li>
    @empty
        <p>No articles yet...</p>
    @endforelse
    </ul>

@endsection
