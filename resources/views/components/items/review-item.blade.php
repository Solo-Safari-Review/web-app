<div class="flex xl:flex-row flex-col gap-8 px-4 py-4 items-center justify-start w-full border-b border-[#535151]/30 has-checked:bg-[#E9D9C7]/30">
    <div class="flex xl:flex-row flex-col gap-8 items-center justify-start w-full">
        <div class="flex gap-6 items-center justify-between xl:justify-start w-full xl:max-w-[300px]">
            <div class="flex gap-4 items-center w-[200px]">
                @if (Auth::user()->hasRole('Admin Review'))
                <input type="checkbox" name="reviews[]" value="{{ $reviewId }}" class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
                @endif
                <span>{{ $username }}</span>
            </div>
            <div class="flex flex-col gap-1 max-w-[100px] w-full">
                <span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#FFFEC4] text-[#907B60]">{{ $category }}</span>
                @if ($department != "")
                <span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#FFFEC4] text-[#907B60]">{{ $department }}</span>
                @else
                <span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#FF8080] text-white">Belum diteruskan</span>
                @endif
            </div>
        </div>
        <span class="grow">{{ \Illuminate\Support\Str::limit($content, 240) }}</span>
    </div>
    <div class="flex gap-2 items-center justify-between xl:justify-start w-full xl:w-fit h-full">
        <x-badges.badge-rating-review rating="{{ $rating }}"></x-badges.badge-rating-review>
        <div class="flex flex-wrap xl:flex-col gap-2 items-center align-middle justify-center">
            {{-- <x-badges.badge-status-review status="{{ $reviewStatus }}"></x-badges.badge-status-review> --}}
            <x-badges.badge-action-review status="{{ $actionStatus }}"></x-badges.badge-action-review>
            <x-badges.badge-answer-status status="{{ $answerStatus }}"></x-badges.badge-answer-status>
        </div>
        <x-buttons.action-button
            id="{{ $reviewId }}"
            show-url="{{ $showUrl }}"
            delete-url="{{ $deleteUrl }}"
            edit-url="{{ $editUrl }}"
            type="{{ $type ?? 'review' }}"
            info="{{ $info }}">
        </x-buttons.action-button>
    </div>
</div>
