@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <div class="flex flex-col gap-4 w-full">
        <span class="grow px-2 py-1 text-2xl font-semibold w-full">Semua Topik</span>
        <div class="flex gap-4 px-2 items-center justify-between xl:justify-end">
            <x-select-all></x-select-all>
        </div>
        <div class="flex flex-col w-full gap-2 py-2">
            @foreach ($categories as $category)
                <x-sections.topics-on-category :topics="$category->topics" categoryName="{!! $category->name !!}"></x-sections.topics-on-category>
            @endforeach
        </div>
    </div>
</div>
@endsection
