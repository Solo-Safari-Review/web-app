@extends('layouts.base')

@section('left-sidebar')

@endsection

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>
    <div class="flex flex-col w-full px-8 py-6 text-[14px] bg-[#DCD7C9] rounded-2xl gap-4 min-h-[160px] shadow-black/25 shadow-lg">
        <span>Di balik setiap ulasan, tersimpan cerita dan pengalaman unik dari para pengunjung. Reveazy membantu kamu memahami lebih dalam apa yang paling sering dibahas dan dipikirkan oleh pengunjung kamu.</span>
        <span class="font-bold">Telusuri topik, kategori, ataupun ulasan. Tanggapi lebih cepat. Tingkatkan pengalaman pengunjung.</span>
    </div>
    <div class="flex flex-col gap-6 w-full">
        <div class="flex gap-2 w-full items-center justify-start">
            <span class="grow px-2 py-1 text-2xl font-semibold">Topik yang dibicarakan</span>
            <a href="{{ route('topics.index') }}" type="button" class="button px-8 py-1 rounded-full bg-[#FFE4B7] text-[16px] hover:bg-[#FFE4B7]/80">Lihat Semua</a>
        </div>
        <div class="flex flex-wrap gap-8 w-full items-center justify-center">
            @foreach ($topTopics as $topic)
                <x-card-topic :topic="$topic"></x-card-topic>
            @endforeach
        </div>
    </div>

    @if(Auth::user()->hasRole('Admin Review'))
    <div class="flex flex-col gap-6 w-full">
        <div class="flex gap-2 w-full items-center justify-start">
            <span class="grow px-2 py-1 text-2xl font-semibold">Kategori</span>
            <a href="{{ route('categories.index') }}" type="button" class="button px-8 py-1 rounded-full bg-[#FFE4B7] text-[16px] hover:bg-[#FFE4B7]/80">Lihat Semua</a>
        </div>
        <div class="flex flex-wrap gap-8 w-full items-center justify-center">
            @foreach ($topCategories as $category)
                <x-card-category :category="$category"></x-card-category>
            @endforeach
        </div>
    </div>
    @endif

    <form action="{{ route('reviews.destroy-some') }}" method="POST" class="flex flex-col gap-6 w-full">
        @csrf
        @method('DELETE')
        <div class="flex gap-4 items-center justify-end">
            <x-select-all item="Ulasan"></x-select-all>
        </div>
        <div class="flex flex-col gap-4 w-full">
            <div class="flex gap-2 items-center w-full">
                <span class="grow px-2 py-1 text-2xl font-semibold">Ulasan Terbaru</span>
                <a href="{{ route('reviews.all', ['sort' => 'time']) }}" type="button" class="button px-8 py-1 rounded-full bg-[#FFE4B7] text-[16px] hover:bg-[#FFE4B7]/80">Lihat Semua</a>
            </div>
            <div class="flex flex-col w-full gap-2 py-2">
                @foreach ($recentReviews as $review)
                    <x-review-item info="recent" :review="$review"></x-review-item>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-4 w-full">
            <div class="flex gap-2 items-center w-full">
                <span class="grow px-2 py-1 text-2xl font-semibold">Ulasan Paling Membantu</span>
                <a href="{{ route('reviews.all', ['sort' => 'likes']) }}" type="button" class="button px-8 py-1 rounded-full bg-[#FFE4B7] text-[16px] hover:bg-[#FFE4B7]/80">Lihat Semua</a>
            </div>
            <div class="flex flex-col w-full gap-2 py-2">
                @foreach ($mostHelpfulReviews as $review)
                    <x-review-item info="helpful" :review="$review"></x-review-item>
                @endforeach
            </div>
        </div>
    </form>
</div>
@endsection
