<div class="flex flex-col gap-4">
    <button type="button" class="px-4 py-4 bg-[#E9D9C7] text-black hover:bg-[#1e1e1e] hover:text-[#e9d9c7] hover:outline-2 hover:outline-[#e9d9c7] rounded-full" aria-controls="{{ $dropdownId }}" data-collapse-toggle="{{ $dropdownId }}">
        <span class="flex flex-col gap-2">
            {{ $slot }}
            <span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                </svg>
            </span>
        </span>
    </button>
    <div id="{{ $dropdownId }}" class="hidden">
        <div class="flex flex-col gap-4">
            @foreach ($multiItems as $item)
            <x-sidebars.sidebar-narrow-button name="{{ $item['name'] }}" route="{{ $item['route'] }}">
                {!! $item['icon'] !!}
            </x-sidebars.sidebar-narrow-button>
            @endforeach
        </div>
    </div>
</div>
