@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <div class="flex flex-col xl:flex-row gap-8 w-full">
        <div class="flex flex-col gap-4 w-full">
            <div class="flex gap-4 items-center w-full">
                <span class="grow py-1 text-2xl font-semibold">Detail Ulasan</span>
                <a href="{{ route('reviews.edit', \App\Helpers\HashidsHelper::encode($review->id)) }}" type="button" id="delete-selected-all" class="text-center text-sm px-6 py-1 rounded-lg bg-[#FFE4B7] hover:bg-[#FFE4B7]/80 border-1 border-gray-300">Edit Ulasan</a>
            </div>
            <div class="flex flex-col w-full gap-4 py-1">
                <div class="flex flex-wrap xl:flex-nowrap w-full gap-8 py-2.5">
                    <div class="flex flex-col w-full gap-4">
                        <label for="category" class="xl:text-lg text-sm font-bold">Kategori</label>
                        <input type="text" name="category" id="category" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ $review->categorizedReview->category->name ?? 'Belum dikategorikan' }}" disabled>
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <label for="department" class="xl:text-lg text-sm font-bold">Departemen</label>
                        <input type="text" name="department" id="department" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ $review->categorizedReview->department->name ?? 'Belum dikirim ke departemen' }}" disabled>
                    </div>
                </div>
                <div class="flex flex-wrap xl:flex-nowrap w-full gap-8 py-2.5">
                    <div class="flex flex-col w-full gap-4">
                        <label for="date" class="xl:text-lg text-sm font-bold">Tanggal Ulasan</label>
                        <input type="text" name="date" id="date" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}" disabled>
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <label for="status" class="xl:text-lg text-sm font-bold">Status</label>
                        <div class="flex gap-4 flex-wrap xl:flex-nowrap w-full">
                            <input type="text" name="reviewStatus" id="reviewStatus" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60] w-full" value="{{ $review->categorizedReview->review_status ?? 'Belum dikategorikan' }}" disabled>
                            <input type="text" name="actionStatus" id="actionStatus" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60] w-full" value="{{ $review->categorizedReview->action_status ?? 'Belum dikategorikan' }}" disabled>
                            <input type="text" name="answerStatus" id="answerStatus" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60] w-full" value="{{ $review->categorizedReview->answer_status ?? 'Belum dikategorikan' }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap xl:flex-nowrap w-full gap-8 py-2.5">
                    <div class="flex flex-col w-full gap-4">
                        <label for="adminReviewComment" class="xl:text-lg text-sm font-bold">Komentar Admin Review</label>
                        <textarea rows="2" name="adminReviewComment" id="adminReviewComment" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>{{ $review->categorizedReview->review_admin_comment ?? 'Belum dikomentari' }}</textarea>
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <label for="adminDepartmentComment" class="xl:text-lg text-sm font-bold">Komentar Admin Departemen</label>
                        <textarea rows="2" name="adminDepartmentComment" id="adminDepartmentComment" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>{{ $review->categorizedReview->department_admin_comment ?? 'Belum dikomentari' }}</textarea>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-4">
                    <div class="flex flex-wrap xl:flex-nowrap gap-4 justify-between">
                        <label for="review" class="xl:text-lg text-sm font-bold">Ulasan oleh {{ $review->username }}</label>
                        <div class="flex gap-4">
                            <label for="rating" class="xl:text-lg text-sm font-bold">Rating: </label>
                            <x-badges.badge-rating-review rating="{{ $review->rating }}"></x-badges.badge-rating-review>
                        </div>
                    </div>
                    <textarea rows="8" name="review" id="review" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>{{ $review->content }}</textarea>
                </div>
                <div class="flex w-full gap-4 items-center">
                    <span class="xl:text-lg text-sm font-bold">Topik: </span>
                    <div class="flex gap-2">
                        @foreach ($review->topics as $topic)
                            <span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] text-[16px] text-center bg-[#FFFEC4] text-[#907B60]">
                                {{ $topic->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
