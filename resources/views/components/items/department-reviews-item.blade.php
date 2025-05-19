<a type="button" href="{{ $showUrl }}" class="flex gap-8 px-2 py-4 items-center justify-between w-full border-b border-[#535151]/30 hover:bg-[#907B60]/30">
    <span>{{ $department->name }}</span>
    <span>{{ $department->categorizedReviews->count() }} Ulasan</span>
</a>
