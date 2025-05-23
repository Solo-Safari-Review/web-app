@if ($type == "review")
<button id="actionButton{{ $id }}{{ $info }}" data-dropdown-toggle="actionMenu{{ $id }}{{ $info }}" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu{{ $id }}{{ $info }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg py-2 min-w-[160px]">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton{{ $id }}{{ $info }}">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Detail</a>
      </li>
      @if (Auth::user()->hasRole('Admin Review'))
      <li>
        <button data-dropdown-toggle="departemenList{{ $id }}{{ $info }}" data-dropdown-placement="right-start" class="flex items-center justify-start gap-2 px-4 py-2 hover:bg-[#C1B6AE] w-full " type="button">
          <span class="text-[16px]">Kirim ke departemen</span>
          <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </button>

        <div id="departemenList{{ $id }}{{ $info }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg py-2 min-w-[160px]">
          <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="departemenList{{ $id }}{{ $info }}">
            @foreach ($departments as $department)
            <form action="{{ route('reviews.store') }}" id="sendReview{{ $id }}{{ $department->id }}" method="POST">
              @csrf
              <input type="hidden" name="review_id" value="{{ $id }}">
              <input type="hidden" name="department_id" value="{{ App\Helpers\HashidsHelper::encode($department->id) }}">
              <button type="button" class="btn block px-4 py-2 hover:bg-[#C1B6AE] w-full text-start" onclick="confirmSendReview('sendReview{{ $id }}{{ $department->id }}')">{{ $department->name }}</button>
            </form>
            @endforeach
          </ul>
        </div>
      </li>
      <li>
        <a href="/" class="block px-4 py-2 hover:bg-[#C1B6AE]">Prediksi rating</a>
      </li>
      <li>
        <form id="deleteReview{{ $id }}" action="{{ $deleteUrl }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="block px-4 py-2 hover:bg-[#C1B6AE] w-full text-start" onclick="confirmDeleteReview('deleteReview{{ $id }}')">Hapus</button>
        </form>
      </li>
      @endif
    </ul>
</div>
@endif

@if ($type == "scraping-review")
<button id="actionButton{{ $id }}{{ $info }}" data-dropdown-toggle="actionMenu{{ $id }}{{ $info }}" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu{{ $id }}{{ $info }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg py-2 min-w-[160px]">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton{{ $id }}{{ $info }}">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Detail</a>
      </li>
    </ul>
</div>
@endif

@if ($type == "category" || $type == "topic")
<button id="actionButton{{ $id }}" data-dropdown-toggle="actionMenu{{ $id }}" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu{{ $id }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg w-[#178px] py-2 min-w-[160px]">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton{{ $id }}">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Daftar Ulasan</a>
      </li>

      @if (Auth::user()->hasRole('Admin Review'))
      <li>
        <a href="{{ $editUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Edit {{ $type == "category" ? "Kategori" : "Topik" }}</a>
      </li>
      <form action="{{ $deleteUrl }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn block px-4 py-2 hover:bg-[#C1B6AE] w-full text-start">Hapus</button>
      </form>
      @endif

    </ul>
</div>
@endif

@if ($type == "sampah")
<button id="actionButton{{ $id }}{{ $info }}" data-dropdown-toggle="actionMenu{{ $id }}{{ $info }}" class="w-[102px] px-7 py-1 rounded-lg bg-[#F1EADA] text-[14px] h-fit border border-[#C1B6AE]" type="button">Aksi</button>

{{-- Dropdown Menu --}}
<div id="actionMenu{{ $id }}{{ $info }}" class="z-10 hidden bg-[#F1EADA] divide-y divide-[#C1B6AE] rounded-lg shadow-lg py-2 min-w-[160px]">
    <ul class="py-2 text-[16px] text-[#1D1B20]" aria-labelledby="actionButton{{ $id }}{{ $info }}">
      <li>
        <a href="{{ $showUrl }}" class="block px-4 py-2 hover:bg-[#C1B6AE]">Lihat Detail</a>
      </li>
    </ul>
</div>
@endif
