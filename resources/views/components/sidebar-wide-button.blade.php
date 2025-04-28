<a href="{{ $href }}" type="button" {{ $attributes->merge(['class' => 'text-[#E9D9C7] flex justify-between gap-4 px-2 py-2 rounded-lg hover:text-[#1E1E1E] hover:bg-[#E9D9C7] active:text-[#1E1E1E] active:bg-[#E9D9C7]']) }}>
    <span class="flex gap-2">
        @isset($icon)
            {{ $icon }}
        @endisset
        <span>{{ $slot }}</span>
    </span>
</a>
