@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container t-mt-10 t-mx-auto t-py-10 t-h-[800px]">
    <div class="t-text-center t-text-5xl t-py-10">1주차 과제</div>
    <div class="t-text-left">
        <div class="t-text-2xl t-mb-2">필수 과제</div>
        <div class="t-mb-10">Laravel 프레임워크로 CRUD 기능 구현</div>

        <div class="t-text-2xl t-mb-2">추가 과제</div>
        <div class="t-mb-10">
            검색 기능 구현 <br />
            페이징 기능 구현 <br />
        </div>

        <div class="t-text-2xl t-mb-2">마감일</div>
        <div class="t-mb-10">2월 13일 (일) 오후 10시 00분</div>
    </div>
</div>
@endsection
