@extends('layouts.base')

@section('main')
<div class="flex flex-col gap-8 px-8 py-8 w-full">
    <x-search-bar></x-search-bar>

    <form id="selected-form" method="POST" class="flex flex-col gap-6 w-full px-2">
        @csrf
        <div class="flex flex-col gap-8 w-full">
            <div class="flex flex-col gap-4 w-full">
                <span class="py-1 text-lg xl:text-2xl font-semibold">Konfirmasi Akun Baru</span>
                <div class="flex gap-6 items-center justify-start">
                    <x-select-all item="confirmAccounts"></x-select-all>
                </div>
            </div>
            <div class="flex flex-col w-full gap-4 py-2">
                <table class="text-left">
                    <thead class="text-lg">
                        <tr>
                            <th class="px-6 py-3"></th>
                            <th class="px-6 py-3">Posisi</th>
                            <th class="px-6 py-3">Nama Akun</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border-b border-[#535151]/30 has-checked:bg-[#E9D9C7]/30">
                            <td class="py-4 px-4">
                                <input type="checkbox" name="users[]" value="{{ \App\Helpers\HashidsHelper::encode($user->id) }}" class="w-[18px] h-[18px] me-4 text-[#907B60] bg-gray-100 border-gray-300 focus:ring-[#907B60]">
                            </td>
                            <td class="py-4 px-4">{{ $user->department->name }}</td>
                            <td class="py-4 px-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td class="py-4 px-4">{{ $user->email }}</td>
                            <td class="py-4 px-4">
                                @if ($user->is_validated == 1)
                                <span class="px-2 py-1 rounded-lg w-[100px] text-[14px] text-center bg-[#CBFFA9] text-[#907B60]">
                                    Sudah terkonfirmasi
                                </span>
                                @else
                                <span class="px-2 py-1 rounded-lg w-[100px] text-[14px] text-center bg-[#FF8080] text-white">
                                    Belum terkonfirmasi
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <a type="button" href="{{ route('confirm-accounts.show-confirm', \App\Helpers\HashidsHelper::encode($user->id)) }}" class="bg-[#E9D9C7] rounded-lg px-4 py-2 hover:bg-[#E9D9C7]/80">
                                    Rincian
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
