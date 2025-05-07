@if ($status == "Belum dikerjakan")
<span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#FF8080] text-white">
    {{ $status }}
</span>
@elseif ($status == "Dalam proses")
<span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#FFFEC4] text-[#907B60]">
    {{ $status }}
</span>
@elseif ($status == "Selesai")
<span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#CBFFA9] text-[#907B60]">
    {{ $status }}
</span>
@endif
