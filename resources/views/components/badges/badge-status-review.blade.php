@if ($status == "Belum diteruskan")
<span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#FF8080] text-white">
    {{ $status }}
</span>
@elseif ($status == "Sudah diteruskan")
<span class="px-2 py-1 rounded-lg w-[100px] text-[10px] text-center bg-[#CBFFA9] text-[#907B60]">
    {{ $status }}
</span>
@endif
