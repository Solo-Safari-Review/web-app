@if ($type == "topic")
<div class="flex xl:flex-row flex-col gap-8 px-4 py-4 items-center justify-between w-full border-b border-[#535151]/30 has-checked:bg-[#E9D9C7]/30">
    <div class="flex gap-4 items-center w-[200px]">
        <input type="checkbox" value="{{ $topic->id }}" class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
        <span>{{ $topic->name }}</span>
    </div>
    <span>{{ $topic->reviews_count }} Ulasan</span>
    <x-action-button id="{{ $topic->id }}" show-url="{{ $showUrl }}" delete-url="{{ $deleteUrl }}" type="{{ $type }}"></x-action-button>
</div>
@endif

@if ($type == "category")
<div class="flex xl:flex-row flex-col gap-8 px-4 py-4 items-center justify-between w-full border-b border-[#535151]/30 has-checked:bg-[#E9D9C7]/30">
    <div class="flex gap-4 items-center w-[200px]">
        <input type="checkbox" value="{{ $category->id }}" class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
        <span>{{ $category->name }}</span>
    </div>
    <span>{{ $category->categorized_reviews_count }} Ulasan</span>
    <x-action-button id="{{ $category->id }}" show-url="{{ $showUrl }}" delete-url="{{ $deleteUrl }}" type="{{ $type }}"></x-action-button>
</div>
@endif
