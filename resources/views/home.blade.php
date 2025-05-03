@extends('layouts.base')

@section('left-sidebar')

@endsection

@section('main')
<div class="flex flex-wrap gap-8 w-full items-center justify-center">
    @foreach ($topTopics as $topic)
        <x-card-topic :topic="$topic"></x-card-topic>
    @endforeach
</div>
<div class="flex flex-wrap gap-8 w-full items-center justify-center">
    @foreach ($topCategories as $category)
        <x-card-category :category="$category"></x-card-category>
    @endforeach
</div>
<div class="flex flex-col gap-4 px-8 py-4">
    @foreach ($reviews as $review)
        <x-review-item :review="$review"></x-review-item>
    @endforeach
</div>
<x-search-bar></x-search-bar>
@endsection

@section('footer')

@endsection
