@extends('layouts.base')

@section('left-sidebar')

@endsection

@section('main')
{{-- @dd($topCategories) --}}
<div class="flex flex-wrap gap-8 w-full items-center justify-center">
    {{-- <x-card-category label="Toilet" number="150"></x-card-category>
    <x-card-category label="Keamanan & Kebersihan" number="87"></x-card-category>
    <x-card-category label="Area Parkir" number="25"></x-card-category>
    <x-card-category label="Hewan" number="7"></x-card-category>
    <x-card-category label="Pegawai" number="5"></x-card-category> --}}
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
