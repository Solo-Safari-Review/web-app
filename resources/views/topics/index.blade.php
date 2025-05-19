@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <form id="deleteTopics" action="{{ route('topics.destroy-some') }}" method="POST" class="flex flex-col gap-4 w-full">
        @csrf
        @method('DELETE')
        <span class="grow px-2 py-1 text-2xl font-semibold w-full">Semua Topik</span>
        <div class="flex gap-4 px-2 items-center justify-between flex-wrap-reverse">
            <div class="flex gap-4 items-center w-full justify-between xl:w-fit">
                <x-select-all form="deleteTopics" title="Hapus Topik" message="Anda yakin ingin menghapus topik yang dipilih?"></x-select-all>
            </div>
            <a href="{{ route('topics.create') }}" class="text-center text-sm px-6 py-1 w-full xl:w-fit rounded-lg bg-[#FFE4B7] border-1 border-gray-300 hover:bg-[#FFE4B7]/80">Tambah Topik</a>
        </div>
        <div class="flex flex-col w-full gap-2 py-2">
            @foreach ($categories as $category)
                <x-sections.topics-on-category :topics="$category->topics" categoryName="{!! $category->name !!}"></x-sections.topics-on-category>
            @endforeach
        </div>
    </form>
</div>
@endsection
