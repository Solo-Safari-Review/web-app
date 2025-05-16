<div class="w-full flex flex-col">
    <div class="px-2 py-4 w-full bg-[#E9D9C7]/50">
        <span>{{ $categoryName }}</span>
    </div>

    @foreach ($topics as $topic)
    <x-items.topic-item-setting :topic="$topic"></x-items.topic-item-setting>
    @endforeach
</div>
