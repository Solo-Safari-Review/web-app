<div class="flex flex-col gap-4">
    <button type="button" {{ $attributes->merge(['class' => 'text-[#E9D9C7] flex justify-between gap-4 px-2 py-2 rounded-lg hover:text-[#1E1E1E] hover:bg-[#E9D9C7] active:text-[#1E1E1E] active:bg-[#E9D9C7]']) }} aria-controls="{{ $dropdownId }}" data-collapse-toggle="{{ $dropdownId }}">
        <span class="flex gap-2">
            @isset($icon)
            <span class="w-8 flex justify-center items-center">{{ $icon }}</span>
            @endisset
            <span class="grow">{{ $slot }}</span>
        </span>
        <span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
            </svg>
        </span>
    </button>
    <div id="{{ $dropdownId }}" class="hidden px-8">
        <div class="flex flex-col gap-2">
            @foreach ($multiItems as $item)
            <x-sidebar-wide-button href="{{ $item['href'] }}">
                <x-slot name="icon">{!! $item['icon'] !!}</x-slot>
                {{ $item['name'] }}
            </x-sidebar-wide-button>
            @endforeach
        </div>
    </div>
</div>
