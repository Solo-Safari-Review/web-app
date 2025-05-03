@if ($type == "review")
<button id="actionButton{{ $id }}" data-dropdown-toggle="actionMenu{{ $id }}" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu{{ $id }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg w-[#178px] py-2 min-w-[160px]">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton{{ $id }}">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Detail</a>
      </li>
      <form action="{{ $deleteUrl }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="block px-4 py-2 hover:bg-[#C1B6AE] w-full text-start">Hapus</button>
      </form>
    </ul>
</div>
@endif

@if ($type == "category" || $type == "topic")
<button id="actionButton{{ $id }}" data-dropdown-toggle="actionMenu{{ $id }}" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu{{ $id }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg w-[#178px] py-2 min-w-[160px]">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton{{ $id }}">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Detail</a>
      </li>
      <form action="{{ $deleteUrl }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="block px-4 py-2 hover:bg-[#C1B6AE] w-full text-start">Hapus</button>
      </form>
    </ul>
</div>
@endif

