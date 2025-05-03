@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <div class="flex flex-col gap-4 w-full">
        <span class="grow px-2 py-1 text-2xl font-semibold w-full">Semua Topik</span>
        <div class="flex flex-col w-full gap-2 py-2">
            @foreach ($topics as $topic)
                <x-category-topic-item-setting :topic="$topic" type="topic"></x-category-topic-item-setting>
            @endforeach
        </div>
    </div>
</div>
@endsection
