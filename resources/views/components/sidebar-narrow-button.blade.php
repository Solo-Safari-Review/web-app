<a href="{{ $href }}" type="button" {{ $attributes->merge(['class' => 'px-4 py-4 bg-[#E9D9C7] text-black hover:bg-[#1e1e1e] hover:text-[#e9d9c7] hover:outline-2 hover:outline-[#e9d9c7] rounded-full']) }}>
    <span class="flex gap-2">
        {{ $slot }}
    </span>
</a>
