<div class="hidden" id="confirmDelete">
    <div class="z-50 flex flex-col min-w-[350px] max-w-[600px] h-[400px] mx-auto gap-6 px-8 xl:px-[72px] py-16 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#D9D9D9] rounded-2xl items-center align-top">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.5 41.25L30 34.75L36.5 41.25L40 37.75L33.5 31.25L40 24.75L36.5 21.25L30 27.75L23.5 21.25L20 24.75L26.5 31.25L20 37.75L23.5 41.25ZM17.5 52.5C16.125 52.5 14.9479 52.0104 13.9688 51.0312C12.9896 50.0521 12.5 48.875 12.5 47.5V15H10V10H22.5V7.5H37.5V10H50V15H47.5V47.5C47.5 48.875 47.0104 50.0521 46.0312 51.0312C45.0521 52.0104 43.875 52.5 42.5 52.5H17.5ZM42.5 15H17.5V47.5H42.5V15Z" fill="#4E1F00"/>
        </svg>
        <div class="w-full flex flex-col gap-8 text-center">
            <span class="font-extrabold" id="confirmDeleteTitle">{{ $title }}</span>
            <p class="font-medium" id="confirmDeleteMessage">{{ $message }}</p>
            <div class="flex justify-between">
                <button type="button" class="button bg-[#2C2C2C] px-4 py-2 rounded-lg text-white" onclick="$('#confirmDelete').hide()">Batalkan</button>
                <button type="submit" id="deleteButton" class="bg-[#4E1F00] px-4 py-2 rounded-lg text-white">Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(form, title, message) {
    $("#confirmDelete").show();
    $("#deleteButton").attr('form', form);
    $("#confirmDeleteTitle").text(title);
    $("#confirmDeleteMessage").text(message);
}
</script>
@endpush
