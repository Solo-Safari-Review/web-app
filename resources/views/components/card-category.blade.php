<a href="{{ $categoryUrl }}" class="flex flex-col px-4 py-4 rounded-2xl bg-[#907B60] text-white items-start align-bottom min-w-[160px] max-w-[224px] shadow-black/25 shadow-lg">
    <span class="font-bold text-[20px]">{{ $category->name }}</span>
    <div class="flex gap-2 items-end align-bottom">
        <span class="font-bold text-[72px]">{{ $category->categorized_reviews_count }}</span>
        <span class="text-[16px]">Ulasan</span>
    </div>
</a>
