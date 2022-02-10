@extends('layout')

@section('content')
    <x-header />

    <form action="/article" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">title</label>
            <x-forms.input id="title" type="text" name="title" />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">body</label>
            <x-forms.textarea id="body" name="body" />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">tags</label>
            <div class="flex gap-2">
                <x-forms.input id="tags" type="text" name="tags[]" />
                <x-forms.input id="tags" type="text" name="tags[]" />
                <x-forms.input id="tags" type="text" name="tags[]" />
            </div>
        </div>

        <x-forms.button type="submit" name="submit" color="blue" />
    </form>

@endsection
