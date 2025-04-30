<!-- wide sidebar -->
<div id="wide-sidebar" class="fixed top-0 left-0 z-40 w-[296px] min-h-full px-4 py-12 transition-transform -translate-x-full bg-[#1E1E1E] flex flex-col gap-12" tabindex="-1" aria-labelledby="wide-sidebar-label">
    <div class="flex justify-between">
        <button type="button" class="text-white bg-transparent hover:bg-[#E9D9C7] rounded-lg text-sm p-1.5 items-center hover:text-[#1E1E1E]">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
              </svg>
            <span class="sr-only">Back</span>
        </button>
        <button type="button" data-drawer-hide="wide-sidebar" aria-controls="wide-sidebar" class="text-white bg-transparent hover:bg-[#E9D9C7] rounded-lg text-sm p-1.5 items-center hover:text-[#1E1E1E]">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
              </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <div class="bg-[#E9D9C7] rounded-[8px] flex flex-col items-center px-6 py-4">
        <span class="font-bold">Karren Gabriella</span>
        <span>Admin Review</span>
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
        <x-sidebar-wide-button>
            <x-slot name="icon">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="None" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                  </svg>
            </x-slot>
            Logout
        </x-sidebar-wide-button>
    </div>
</div>
