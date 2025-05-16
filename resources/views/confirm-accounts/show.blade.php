@extends('layouts.base')

@section('main')
<div class="w-full max-w-5xl mx-auto h-full flex flex-col justify-center gap-4 mt-24 mb-24 xl:mt-0 xl:mb-0 px-4 xl:px-0">
    <h1 class="font-bold text-[28px]">Konfirmasi Akun Baru</h1>
    <h2 class="text-lg">Detail Akun</h2>
    <table class="text-left">
        <thead class="bg-[#907B60] text-white">
            <tr>
                <th class="px-6 py-3">Item</th>
                <th class="px-6 py-3">Keterangan</th>
            </tr>
        </thead>
        <tbody class="bg-[#E9D9C7]">
            <tr>
                <th class="px-6 py-3">Nama Depan</th>
                <td class="px-6 py-3">{{ $user->first_name }}</td>
            </tr>
            <tr>
                <th class="px-6 py-3">Nama Belakang</th>
                <td class="px-6 py-3">{{ $user->last_name }}</td>
            </tr>
            <tr>
                <th class="px-6 py-3">Email</th>
                <td class="px-6 py-3">{{ $user->email }}</td>
            </tr>
            <tr>
                <th class="px-6 py-3">Nomor Handphone</th>
                <td class="px-6 py-3">{{ $user->phone }}</td>
            </tr>
            <tr>
                <th class="px-6 py-3">Posisi</th>
                <td class="px-6 py-3"></td>
            </tr>
        </tbody>
    </table>
    <form action="{{ route('confirm-accounts.confirm-some') }}" method="POST" class="flex justify-center w-full">
        @csrf
        @method('PUT')
        <input type="hidden" name="users[]" value="{{ \App\Helpers\HashidsHelper::encode($user->id) }}">
        <button type="submit" class="bg-[#4E1F00] text-white px-4 py-2 rounded-lg min-w-[324px] hover:bg-[#4E1F00]/80">Konfirmasi Akun</button>
    </form>
</div>
@endsection
