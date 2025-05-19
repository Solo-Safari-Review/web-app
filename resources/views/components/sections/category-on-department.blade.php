<div class="w-full flex flex-col">
    <div class="px-2 py-4 w-full bg-[#E9D9C7]/50">
        <span>Departemen: {{ $departmentName }}</span>
    </div>

    @foreach ($categories as $category)
    <x-items.category-item-setting :category="$category"></x-items.category-item-setting>
    @endforeach
</div>
