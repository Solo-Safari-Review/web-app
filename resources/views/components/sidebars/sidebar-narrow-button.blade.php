<a href="{{ $route != '#' ? route($route) : '#' }}" type="button" class="flex justify-center items-center px-4 py-4 hover:bg-[#1e1e1e] hover:text-[#e9d9c7] hover:outline-2 hover:outline-[#e9d9c7] rounded-full {{ $route != '#' && request()->routeIs($route) ? 'bg-[#4E1F00] text-white cursor-not-allowed pointer-events-none' : 'bg-[#E9D9C7] text-black' }}">
    <span class="flex gap-2">
        {{ $slot }}
    </span>
</a>
