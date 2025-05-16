@extends('layouts.base')

@section('main')
<form id="deleteSomeForm" action="{{ route('reviews.destroy-some') }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="flex flex-col gap-8 px-8 py-8 w-full">
        <x-search-bar></x-search-bar>

        <div class="flex flex-col xl:flex-row gap-8 w-full">
            @include('reviews.components.filter-panel-small')

            <div class="flex flex-col gap-4 grow">
                <div class="flex gap-4 items-center w-full">
                    <span class="grow px-2 py-1 text-2xl font-semibold">Semua Ulasan</span>

                    @if (Auth::user()->hasRole('Admin Review'))
                    <x-select-all item="Ulasan"></x-select-all>
                    @endif

                </div>
                <div class="flex flex-col w-full gap-2 py-2">
                    @foreach ($reviews as $review)
                        <x-items.review-item info="recent" :review="$review"></x-items.review-item>
                    @endforeach
                </div>
                <div>
                    {{ $reviews->links() }}
                </div>
            </div>

            @include('reviews.components.filter-panel-wide')
        </div>
    </div>
</form>
@endsection
