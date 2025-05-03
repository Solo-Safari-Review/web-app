@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full h-fit">
    <div class="w-full">
        <x-search-bar></x-search-bar>
    </div>
    <div class="flex flex-col gap-4 w-full">
        <span class="w-full text-2xl px-2 py-1">Hasil Pencarian: {{ $query }}</span>
        <div class="w-full px-2">
            @foreach ($searchResults as $searchResult)
            <a href="{{ $searchResult->url }}" class="flex gap-8 px-8 py-4 items-center justify-start hover:bg-[#907B60]/50 border-b border-[#535151]/30 text-lg">
                <span class="font-bold min-w-[84px]">
                    @if ($searchResult->type == 'reviews')
                        Review
                    @elseif ($searchResult->type == 'categories')
                        Kategori
                    @elseif ($searchResult->type == 'topics')
                        Topik
                    @endif
                </span>
                <span>{{ $searchResult->title }}</span>
            </a>
            @endforeach
        </div>
        {{ $searchResults->links() }}
    </div>
</div>
@endsection

