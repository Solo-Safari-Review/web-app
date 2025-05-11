<div class="hidden" id="confirm">
    <div class="z-50 flex flex-col min-w-[350px] max-w-[600px] h-[400px] mx-auto gap-8 px-8 xl:px-[72px] py-16 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#D9D9D9] rounded-2xl items-center justify-around">
        <svg width="96" height="96" viewBox="0 0 59 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M25.1419 43.3426L45.7044 22.7801L41.6211 18.6968L25.1419 35.1759L16.8294 26.8634L12.7461 30.9468L25.1419 43.3426ZM29.2253 59.0926C25.1905 59.0926 21.3989 58.327 17.8503 56.7957C14.3016 55.2645 11.2148 53.1864 8.58984 50.5614C5.96484 47.9364 3.88672 44.8496 2.35547 41.3009C0.824219 37.7523 0.0585938 33.9607 0.0585938 29.9259C0.0585938 25.8912 0.824219 22.0996 2.35547 18.5509C3.88672 15.0023 5.96484 11.9155 8.58984 9.29053C11.2148 6.66553 14.3016 4.5874 17.8503 3.05615C21.3989 1.5249 25.1905 0.759277 29.2253 0.759277C33.26 0.759277 37.0516 1.5249 40.6003 3.05615C44.1489 4.5874 47.2357 6.66553 49.8607 9.29053C52.4857 11.9155 54.5638 15.0023 56.0951 18.5509C57.6263 22.0996 58.3919 25.8912 58.3919 29.9259C58.3919 33.9607 57.6263 37.7523 56.0951 41.3009C54.5638 44.8496 52.4857 47.9364 49.8607 50.5614C47.2357 53.1864 44.1489 55.2645 40.6003 56.7957C37.0516 58.327 33.26 59.0926 29.2253 59.0926ZM29.2253 53.2593C35.7391 53.2593 41.2565 50.9989 45.7773 46.478C50.2982 41.9572 52.5586 36.4398 52.5586 29.9259C52.5586 23.4121 50.2982 17.8947 45.7773 13.3739C41.2565 8.85303 35.7391 6.59261 29.2253 6.59261C22.7114 6.59261 17.194 8.85303 12.6732 13.3739C8.15234 17.8947 5.89193 23.4121 5.89193 29.9259C5.89193 36.4398 8.15234 41.9572 12.6732 46.478C17.194 50.9989 22.7114 53.2593 29.2253 53.2593Z" fill="#4E1F00"/>
        </svg>
        <div class="w-full flex flex-col gap-8 text-center">
            <div class="flex flex-col gap-4">
                <span class="font-extrabold text-xl" id="confirmTitle">{{ $title }}</span>
                <p class="font-medium" id="confirmMessage">{{ $message }}</p>
            </div>
            <div class="flex justify-around">
                <button type="button" class="button bg-[#2C2C2C] hover:bg-[#2C2C2C]/80 px-4 py-2 rounded-lg text-white" onclick="$('#confirm').hide()">Tidak</button>
                <button id="confirmButton" type="submit" class="bg-[#4E1F00] hover:bg-[#4E1F00]/80 px-4 py-2 rounded-lg text-white">Iya</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirm(form, title, message) {
    $("#confirm").show();
    $("#confirmButton").attr('form', form);
    $("#confirmTitle").text(title);
    $("#confirmMessage").text(message);
}
</script>
@endpush
