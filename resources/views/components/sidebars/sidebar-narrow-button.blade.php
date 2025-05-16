<a data-tooltip-target="tooltip-{{ $name }}" data-tooltip-placement="right" href="{{ $route != '#' ? route($route) : '#' }}" type="button" class="flex justify-center items-center px-4 py-4 hover:bg-[#1e1e1e] hover:text-[#e9d9c7] hover:outline-2 hover:outline-[#e9d9c7] rounded-full {{ $route != '#' && request()->routeIs($route) ? 'bg-[#4E1F00] text-white cursor-not-allowed pointer-events-none' : 'bg-[#E9D9C7] text-black' }}">
    <span class="flex gap-2">
        {{ $slot }}
    </span>
</a>

<div id="tooltip-{{ $name }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-[#4E1F00] rounded-lg shadow-xs opacity-0 tooltip">
    {{ $name }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
