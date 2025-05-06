<div class="flex xl:flex-row flex-col gap-8 px-4 py-4 items-center justify-start w-full border-b border-[#535151]/30 has-checked:bg-[#E9D9C7]/30">
    <div class="flex xl:flex-row flex-col gap-8 items-center justify-start w-full">
        <div class="flex gap-6 items-center justify-between xl:justify-start w-full xl:max-w-[300px]">
            <div class="flex gap-4 items-center w-[200px]">
                <input type="checkbox" name="reviews[]" value="{{ $reviewId }}" class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
                <span>{{ $username }}</span>
            </div>
            <span class="max-w-[100px] w-full">{{ $category }}</span>
        </div>
        <span class="grow">{{ \Illuminate\Support\Str::limit($content, 240) }}</span>
    </div>
    <div class="flex gap-2 items-center justify-between xl:justify-start w-full xl:w-fit h-full">
        <x-badge-rating-review rating="{{ $rating }}"></x-badge-rating-review>
        <div class="flex flex-wrap xl:flex-col gap-2 items-center align-middle justify-center">
            <x-badge-status-review status="{{ $reviewStatus }}"></x-badge-status-review>
            <x-badge-action-review status="{{ $actionStatus }}"></x-badge-action-review>
            <x-badge-answer-status status="{{ $answerStatus }}"></x-badge-answer-status>
        </div>
        <x-action-button
            id="{{ $reviewId }}"
            show-url="{{ $showUrl }}"
            delete-url="{{ $deleteUrl }}"
            type="review"
            info="{{ $info }}">
        </x-action-button>
    </div>
</div>
