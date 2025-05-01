@if ($rating == 1)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] w-[48px] text-[16px] text-center bg-[#FF8080] text-white">
@elseif ($rating == 2)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] w-[48px] text-[16px] text-center bg-[#FF9B9B] text-white">
@elseif ($rating == 3)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] w-[48px] text-[16px] text-center bg-[#FFD6A5] text-white">
@elseif ($rating == 4)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] w-[48px] text-[16px] text-center bg-[#FFFEC4] text-[#907B60]">
@elseif ($rating == 5)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] w-[48px] text-[16px] text-center bg-[#CBFFA9] text-[#907B60]">
@endif
    <span>
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4.69258 8.9125L6.26758 7.9625L7.84258 8.925L7.43008 7.125L8.81758 5.925L6.99258 5.7625L6.26758 4.0625L5.54258 5.75L3.71758 5.9125L5.10508 7.125L4.69258 8.9125ZM3.18008 11L3.99258 7.4875L1.26758 5.125L4.86758 4.8125L6.26758 1.5L7.66758 4.8125L11.2676 5.125L8.54258 7.4875L9.35508 11L6.26758 9.1375L3.18008 11Z" fill="currentColor"/>
        </svg>
    </span>
    <span>{{ $rating }}</span>
</span>
