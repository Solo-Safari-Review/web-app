<div class="flex xl:flex-row flex-col gap-8 px-2 py-4 xl:items-center items-end justify-between w-full border-b border-[#535151]/30 has-checked:bg-[#E9D9C7]/30">
    <div class="flex gap-1 items-center w-full justify-start xl:w-[200px]">
        @if (Auth::user()->hasRole('Admin Review'))
        <input type="checkbox" name="categories[]" value="{{ \App\Helpers\HashidsHelper::encode($category->id) }}" class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
        @endif

        <span class="grow xl:grow-0">{{ $category->name }}</span>
        <span class="block xl:hidden min-w-[80px] text-right">{{ $category->categorized_reviews_count }} Ulasan</span>
    </div>
    <span class="hidden xl:block">{{ $category->categorized_reviews_count }} Ulasan</span>
    <x-buttons.action-button id="{{ \App\Helpers\HashidsHelper::encode($category->id) }}" show-url="{{ $showUrl }}" delete-url="{{ $deleteUrl }}" type="{{ $type }}"></x-buttons.action-button>
</div>
