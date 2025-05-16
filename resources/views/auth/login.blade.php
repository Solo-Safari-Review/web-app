@extends('layouts.base')

@section('main')
<div class="w-screen h-fit xl:h-screen flex flex-col xl:flex-row items-center justify-center bg-[#203B37] gap-16 xl:gap-[184px] px-4 xl:px-14 py-[72px]">
    <div class="h-full flex flex-col px-4 xl:px-0 gap-8 xl:gap-[56px] w-full xl:w-[360px] text-white font-kaisei">
        <span class="xl:text-[56px] text-[36px]">Reveazy</span>
        <span class="xl:text-[36px] text-[24px]">“Smart Insights from Every Review”</span>
    </div>
    <div class="w-full max-w-2xl xl:w-[736px] bg-[#F1EADA] rounded-3xl px-4 xl:px-20 py-8 xl:py-24 items-center flex flex-col gap-16">
        <div class="flex flex-col gap-4 items-center">
            <span class="text-[30px] font-medium">Selamat Datang</span>
            <span class="text-[16px] font-light">Silahkan isi email dan kata sandi untuk masuk</span>
        </div>
        <form class="flex flex-col gap-6 items-center w-full xl:w-[513px]" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-4 w-full">
                <label for="email" class="xl:text-lg text-sm">Email</label>
                <input type="email" name="email" id="email" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ old('email') }}">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full items-end">
                <div class="flex flex-col gap-4 w-full">
                    <label for="password" class="xl:text-lg text-sm">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]">
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <a href="{{ route('forgot-password.show') }}" class="underline xl:text-lg text-sm">Lupa kata sandi?</a>
            </div>
            <button type="submit" class="bg-[#907B60] text-white rounded-3xl px-4 py-2 text-center w-full xl:w-[400px] mt-8 hover:bg-[#907B60]/80">Masuk</button>
        </form>
        <div class="w-full text-center xl:text-[16px] text-sm">
            <span>Belum memiliki akun? <a href="{{ route('register.show') }}"" class="underline text-[#4E1F00]">Daftar Akun</a></span>
        </div>
    </div>
</div>
@endsection

