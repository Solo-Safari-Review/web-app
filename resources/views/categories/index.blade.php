@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <form id="deleteCategories" action="{{ route('categories.destroy-some') }}" method="POST" class="flex flex-col gap-4 w-full">
        @csrf
        @method('DELETE')
        <span class="grow px-2 py-1 text-2xl font-semibold w-full">Semua Kategori</span>
        <div class="flex gap-4 px-2 items-center justify-between xl:justify-end">
            <x-select-all form="deleteCategories" title="Hapus Kategori" message="Anda yakin ingin menghapus kategori yang dipilih?"></x-select-all>
        </div>
        <div class="flex flex-col w-full gap-2 py-2">
            @foreach ($categories as $category)
                <x-items.category-item-setting :category="$category"></x-items.category-item-setting>
            @endforeach
        </div>
    </form>
</div>
@endsection
