<div class="hidden" id="confirmSendReview">
    <div class="z-50 flex flex-col min-w-[350px] max-w-[600px] h-[400px] mx-auto gap-6 px-8 xl:px-[72px] py-16 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#D9D9D9] rounded-2xl items-center align-top">
        <svg width="60" height="61" viewBox="0 0 60 61" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5 50.926V10.926L55 30.926L7.5 50.926ZM12.5 43.426L42.125 30.926L12.5 18.426V27.176L27.5 30.926L12.5 34.676V43.426Z" fill="#4E1F00"/>
        </svg>
        <div class="w-full flex flex-col gap-8 text-center">
            <span class="font-extrabold">Kirim Ulasan</span>
            <p class="font-medium">Apakah anda yakin untuk mengirim ulasan ini? Pastikan Anda sudah benar dalam memilih departemen yang Anda tuju.</p>
            <div class="flex justify-between">
                <button type="button" class="button bg-[#2C2C2C] px-4 py-2 rounded-lg text-white" onclick="$('#confirmSendReview').hide()">Batalkan</button>
                <button id="sendReviewButton" type="submit" class="bg-[#4E1F00] px-4 py-2 rounded-lg text-white">Kirim</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmSendReview(form) {
    $("#confirmSendReview").show();
    $("#sendReviewButton").attr('form', form);
}
</script>
@endpush
