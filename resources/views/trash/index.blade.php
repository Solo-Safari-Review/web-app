@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <form id="deleteSomeForm" action="{{ route('trash.destroy') }}" method="POST" class="flex flex-col gap-6 w-full px-2">
        @csrf
        @method('DELETE')
        <div class="flex gap-4 items-center justify-end">
            <x-select-all item="Sampah"></x-select-all>
        </div>
        <div class="flex flex-col gap-4 w-full">
            <div class="flex gap-2 items-center w-full justify-between">
                <span class="py-1 text-lg xl:text-2xl font-semibold">Review yang telah dihapus</span>
            </div>
            <div class="flex flex-col w-full gap-2 py-2">
                @foreach ($reviews as $review)
                    <x-items.review-item type="sampah" :review="$review"></x-items.review-item>
                @endforeach
            </div>
            <div>
                {{ $reviews->links() }}
            </div>
        </div>
    </form>
</div>
@endsection
