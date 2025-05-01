<!-- wide sidebar -->
<div id="wide-sidebar" class="fixed top-0 left-0 z-40 w-[296px] h-screen px-4 py-12 overflow-y-scroll xl:overflow-y-clip transition-transform -translate-x-full bg-[#1E1E1E] flex flex-col gap-12" tabindex="-1" aria-labelledby="wide-sidebar-label">
    <div class="hidden xl:flex justify-between">
        <a href="{{ url()->previous() }}" type="button" class="text-white bg-transparent hover:bg-[#E9D9C7] rounded-lg text-sm p-1.5 items-center hover:text-[#1E1E1E]">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
              </svg>
            <a class="sr-only">Back</a>
            </a>
        <button type="button" data-drawer-hide="wide-sidebar" aria-controls="wide-sidebar" class="text-white bg-transparent hover:bg-[#E9D9C7] rounded-lg text-sm p-1.5 items-center hover:text-[#1E1E1E]">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
              </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <div class="bg-[#E9D9C7] rounded-[8px] flex flex-col items-center px-6 py-4">
        <span class="font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
        @if (Auth::user()->hasRole('Admin Review'))
        <span>Admin Review</span>
        @elseif (Auth::user()->hasRole('Admin Departemen'))
        <span>Admin Departemen</span>
        @endif
    </div>

    <div class="flex flex-col gap-[128px]">
        <div class="flex flex-col gap-4">
            @foreach ($sidebarItems as $item)
            @if ($item['name'] == 'Pengaturan')
            <x-sidebar-wide-multi-button dropdown-id="setting-menu-wide" :multi-items="$multiItems">
                <x-slot name="icon">{!! $item['icon'] !!}</x-slot>
                {{ $item['name'] }}
            </x-sidebar-wide-multi-button>
            @else
            <x-sidebar-wide-button href="{{ $item['href'] }}">
                <x-slot name="icon">{!! $item['icon'] !!}</x-slot>
                {{ $item['name'] }}
            </x-sidebar-wide-button>
            @endif
            @endforeach
        </div>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="text-[#E9D9C7] flex justify-between gap-4 px-2 py-2 rounded-lg hover:text-[#1E1E1E] hover:bg-[#E9D9C7] active:text-[#1E1E1E] active:bg-[#E9D9C7] w-full">
                <span class="flex gap-2">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="None" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                    </svg>
                    <span>Logout</span>
                </span>
            </button>
        </form>
    </div>
</div>
