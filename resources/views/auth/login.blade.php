@extends('layouts.base')

@section('main')
<div class="w-screen h-screen flex items-center justify-center bg-[#203B37] gap-[184px] px-14 py-[72px]">
    <div class="h-full flex flex-col gap-[56px] w-[360px] text-white font-kaisei">
        <span class="text-[56px]">Reveazy</span>
        <span class="text-[36px]">“Smart Insights from Every Review”</span>
    </div>
    <div class="w-[736px] bg-[#F1EADA] rounded-3xl px-20 py-24 items-center flex flex-col gap-24">
        <div class="flex flex-col gap-4 items-center">
            <span class="text-[30px] font-medium">Selamat Datang</span>
            <span class="text-[16px] font-light">Silahkan isi email dan password untuk masuk</span>
        </div>
        <form class="flex flex-col gap-6 items-center w-[513px] border" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-4 w-full">
                <label for="email" class="text-lg">Email</label>
                <input type="email" name="email" id="email" class="bg-[#D9D9D9] rounded-2xl px-4 py-2">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full items-end">
                <div class="flex flex-col gap-4 w-full">
                    <label for="password" class="text-lg">Password</label>
                    <input type="password" name="password" id="password" class="bg-[#D9D9D9] rounded-2xl px-4 py-2">
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('forgot-password.show') }}" class="underline">Lupa password?</a>
            </div>
            <button type="submit" class="bg-[#907B60] text-white rounded-3xl px-4 py-2 text-center w-[400px]">Masuk</button>
        </form>
        <div class="w-full text-center">
            <span>Belum memiliki akun? <a href="/register" class="underline text-[#4E1F00]">Daftar Akun</a></span>
        </div>
    </div>
</div>
@endsection

