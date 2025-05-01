<button id="actionButton" data-dropdown-toggle="actionMenu" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg w-[#178px] py-2">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Detail</a>
      </li>
      <li>
        <a href="{{ $editUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Kirim ke Departemen</a>
      </li>
      <li>
        <a href="{{ $editUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Tambah Komentar</a>
      </li>
      <li>
        <a href="{{ $deleteUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Hapus</a>
      </li>
    </ul>
</div>
