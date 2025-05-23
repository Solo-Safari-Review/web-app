@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <form id="confirm-form" action="/" method="POST" class="flex flex-col gap-6 w-full px-2">
        <div class="flex flex-col gap-4 w-full">
            <div class="flex gap-2 items-center w-full justify-between">
                <span class="py-1 text-lg xl:text-2xl font-semibold">Ulasan yang didapat</span>
            </div>
            <div class="flex flex-col w-full gap-2 py-2 max-h-[600px] overflow-scroll">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Pengulas</th>
                            <th class="px-6 py-4">Ulasan</th>
                            <th class="px-6 py-4">Rating Asli</th>
                            <th class="px-6 py-4">Rating Prediksi</th>
                            <th class="px-6 py-4">Apakah ulasan ini membantu?</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                        <tr class="">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $review->username }}</td>
                            <td class="px-6 py-4">{{ $review->content }}</td>
                            <td class="px-6 py-4"><x-badges.badge-rating-review rating="{{ $review->rating }}"></x-badges.badge-rating-review></td>
                            <td class="px-6 py-4"><x-badges.badge-rating-review rating="{{ $review->predicted_rating }}"></x-badges.badge-rating-review></td>
                            <td class="px-6 py-4"><x-badges.badge-yes-no status="{{ $review->is_helpful ?? 0 }}"></x-badges.badge-yes-no></td>
                            <td class="px-6 py-4"><x-buttons.action-button type="scraping-review" id="{{ $review->id }}" show-url="/" edit-url="" delete-url=""></x-buttons.action-button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
@endsection
