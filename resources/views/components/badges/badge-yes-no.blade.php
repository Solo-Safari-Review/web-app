@if ($status == 0)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] text-[16px] text-center bg-[#FF8080] text-white">
    <span>Tidak</span>
</span>
@elseif ($status == 1)
<span class="flex gap-1 items-center justify-center px-2 py-1 rounded-[12px] text-[16px] text-center bg-[#CBFFA9] text-[#907B60]">
    <span>Iya</span>
</span>
@endif
