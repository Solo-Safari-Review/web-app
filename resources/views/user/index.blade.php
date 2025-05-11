@extends('layouts.base')

@section('main')
<form id="edit-form" action="{{ route('user.update', $updateUrl) }}" method="POST" class="w-full max-w-5xl mx-auto h-full flex flex-col justify-center gap-4 mt-24 mb-24 xl:mt-0 xl:mb-0 px-4 xl:px-0">
    @csrf
    @method('PUT')
    <h1 class="font-bold text-[28px]">Informasi Akun</h1>
    <div class="flex flex-col gap-8 px-8 py-8 xl:py-24 bg-[#E9D9C7] w-full rounded-lg shadow-xl">
        <div class="w-full flex justify-end">
            <div id="save-hidden" class="hidden">
                <button type="button" id="save-button" class="rounded-lg px-4 py-1 text-white bg-[#4E1F00] flex gap-2 items-center hover:bg-[#4E1F00]/80" onclick="confirm('edit-form', 'Simpan Perubahan Akun', 'Apakah Anda sudah yakin dengan informasi yang baru?')">
                    <svg width="21" height="21" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.92227 18.9091L20.5223 8.30911L19.0973 6.90911L9.89727 16.0841L5.67227 11.8341L4.24727 13.2591L9.92227 18.9091ZM9.92227 21.7341L1.44727 13.2591L5.67227 9.00911L9.92227 13.2591L19.0723 4.08411L23.3723 8.28411L9.92227 21.7341Z" fill="white"/>
                    </svg>
                    <span>Konfirmasi</span>
                </button>
            </div>
            <div id="edit-hidden">
                <button type="button" id="edit-button" class="rounded-lg px-4 py-1 text-white bg-[#4E1F00] flex gap-2 items-center hover:bg-[#4E1F00]/80">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.15104 16.035H6.33854L14.4844 7.88916L13.2969 6.70166L5.15104 14.8475V16.035ZM3.48438 17.7017V14.16L14.4844 3.18083C14.651 3.02805 14.8351 2.90999 15.0365 2.82666C15.2378 2.74333 15.4497 2.70166 15.6719 2.70166C15.8941 2.70166 16.1094 2.74333 16.3177 2.82666C16.526 2.90999 16.7066 3.03499 16.8594 3.20166L18.0052 4.36833C18.1719 4.5211 18.2934 4.70166 18.3698 4.90999C18.4462 5.11833 18.4844 5.32666 18.4844 5.53499C18.4844 5.75722 18.4462 5.96902 18.3698 6.17041C18.2934 6.3718 18.1719 6.55583 18.0052 6.72249L7.02604 17.7017H3.48438ZM13.8802 7.30583L13.2969 6.70166L14.4844 7.88916L13.8802 7.30583Z" fill="currentColor"/>
                    </svg>
                    <span>Ubah Profil</span>
                </button>
            </div>
        </div>
        <div class="w-full flex justify-around gap-4 xl:gap-16 flex-col xl:flex-row">
            <div class="flex flex-col gap-4 w-full">
                <label class="font-semibold" for="first_name">Nama Depan</label>
                <input type="text" name="first_name" id="first_name" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" value="{{ $user->first_name }}" disabled>
                @error('first_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label class="font-semibold" for="last_name">Nama Belakang</label>
                <input type="text" name="last_name" id="last_name" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" value="{{ $user->last_name }}" disabled>
                @error('last_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="w-full flex justify-around gap-4 xl:gap-16 flex-col xl:flex-row">
            <div class="flex flex-col gap-4 w-full">
                <label class="font-semibold" for="phone">Nomor Handphone</label>
                <input type="text" name="phone" id="phone" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" value="{{ $user->phone }}" disabled>
                @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label class="font-semibold" for="email">Email</label>
                <input type="email" name="email" id="email" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" value="{{ $user->email }}" disabled>
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="w-full flex justify-around gap-4 xl:gap-16 flex-col-reverse xl:flex-row">
            <div class="flex flex-col gap-8 w-full">
                <div class="flex flex-col gap-4 w-full">
                    <label class="font-semibold" for="password">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" disabled placeholder="Ubah profil untuk mengubah kata sandi">
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="hidden" id="password-confirmation-hidden">
                    <div class="flex flex-col gap-4 w-full">
                        <label class="font-semibold" for="password_confirmation">Ulangi Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" disabled>
                        @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 w-full">
                <label class="font-semibold" for="role">Posisi</label>
                <input type="text" name="role" id="role" class="bg-white border-0 rounded-2xl px-4 py-1 focus:outline-[#4E1F00] focus:ring-0 disabled:text-black/50" value="{{ $user->getRoleNames()->first() }}" disabled>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#edit-button').click(function () {
        $(this).hide();
        $('#save-hidden').show();
        $('#password-confirmation-hidden').show();

        $('#first_name').prop('disabled', false).focus();
        $('#last_name').prop('disabled', false);
        $('#phone').prop('disabled', false);
        $('#email').prop('disabled', false);
        $('#password').prop('disabled', false).prop('placeholder', '');
        $('#password_confirmation').prop('disabled', false);
    });
});
</script>
@endpush
