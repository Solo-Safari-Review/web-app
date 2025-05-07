<a href="{{ $route != '#' ? route($route) : '#' }}" type="button" class="flex justify-between gap-4 px-2 py-2 rounded-lg hover:text-[#1E1E1E] hover:bg-[#E9D9C7] {{ $route != '#' && request()->routeIs($route) ? 'bg-[#4E1F00] text-white cursor-not-allowed pointer-events-none' : 'text-[#E9D9C7]' }}">
    <span class="flex gap-2">
        @isset($icon)
        <span class="w-8 flex justify-center items-center">{{ $icon }}</span>
        @endisset
        <span class="grow">{{ $slot }}</span>
    </span>
</a>
