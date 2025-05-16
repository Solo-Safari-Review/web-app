@extends('layouts.base')

@section('main')
<div class="w-screen h-fit flex flex-col xl:flex-row items-center justify-center bg-[#203B37] gap-16 xl:gap-[184px] px-4 xl:px-14 py-[72px]">
    <div class="h-full flex flex-col px-4 xl:px-0 gap-8 xl:gap-[56px] w-full xl:w-[360px] text-white font-kaisei">
        <span class="xl:text-[56px] text-[36px]">Reveazy</span>
        <span class="xl:text-[36px] text-[24px]">“Smart Insights from Every Review”</span>
    </div>
    <div class="w-full max-w-2xl xl:w-[736px] bg-[#F1EADA] rounded-3xl px-4 xl:px-20 py-8 xl:py-24 items-center flex flex-col gap-16">
        <div class="flex flex-col gap-4 items-center">
            <span class="text-[30px] font-medium">Daftar Akun</span>
            <span class="text-[16px] font-light">Silahkan isi formulir di bawah</span>
        </div>
        <form class="flex flex-col gap-6 items-center w-full xl:w-[513px]" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-4 w-full">
                <label for="email" class="xl:text-lg text-sm">Email</label>
                <input type="email" name="email" id="email" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ old('email') }}">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full">
                <div class="flex flex-col xl:flex-row gap-4 w-full">
                    <div class="flex flex-col gap-2 w-full">
                        <label for="first_name" class="xl:text-lg text-sm">Nama Depan</label>
                        <input type="text" name="first_name" id="first_name" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ old('first_name') }}">
                        @error('first_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <label for="last_name" class="xl:text-lg text-sm">Nama Belakang</label>
                        <input type="text" name="last_name" id="last_name" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ old('last_name') }}">
                        @error('last_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label for="phone" class="xl:text-lg text-sm">Nomor Handphone</label>
                <input type="text" name="phone" id="phone" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ old('phone') }}">
                @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label for="department" class="xl:text-lg text-sm">Posisi</label>
                <select name="department" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]">
                    @foreach ($departments as $department)
                        <option value="{{ \App\Helpers\HashidsHelper::encode($department->id) }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label for="password" class="xl:text-lg text-sm">Kata Sandi</label>
                <input type="password" name="password" id="password" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label for="password_confirmation" class="xl:text-lg text-sm">Ulangi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 focus:border-[#907B60] focus:ring-[#907B60]">
                @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-[#907B60] text-white rounded-3xl px-4 py-2 text-center w-full xl:w-[400px] mt-8 hover:bg-[#907B60]/80">Daftar</button>
        </form>
        <div class="w-full text-center xl:text-[16px] text-sm">
            <span>Sudah memiliki akun? <a href="{{ route('login.show') }}" class="underline text-[#4E1F00]">Masuk Akun</a></span>
        </div>
    </div>
</div>
@endsection

