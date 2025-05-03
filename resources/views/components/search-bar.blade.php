<button type="button" class="btn w-full max-w-[608px] flex justify-start items-center gap-4 px-6 py-2 text-white bg-[#907B60] rounded-4xl min-h-[50px]" data-modal-target="search-menu" data-modal-toggle="search-menu" aria-controls="search-menu">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19.6 21L13.3 14.7C12.8 15.1 12.225 15.4167 11.575 15.65C10.925 15.8833 10.2333 16 9.5 16C7.68333 16 6.14583 15.3708 4.8875 14.1125C3.62917 12.8542 3 11.3167 3 9.5C3 7.68333 3.62917 6.14583 4.8875 4.8875C6.14583 3.62917 7.68333 3 9.5 3C11.3167 3 12.8542 3.62917 14.1125 4.8875C15.3708 6.14583 16 7.68333 16 9.5C16 10.2333 15.8833 10.925 15.65 11.575C15.4167 12.225 15.1 12.8 14.7 13.3L21 19.6L19.6 21ZM9.5 14C10.75 14 11.8125 13.5625 12.6875 12.6875C13.5625 11.8125 14 10.75 14 9.5C14 8.25 13.5625 7.1875 12.6875 6.3125C11.8125 5.4375 10.75 5 9.5 5C8.25 5 7.1875 5.4375 6.3125 6.3125C5.4375 7.1875 5 8.25 5 9.5C5 10.75 5.4375 11.8125 6.3125 12.6875C7.1875 13.5625 8.25 14 9.5 14Z" fill="white"/>
    </svg>
    <span class="">
        Cari kategori/topik/ulasan
    </span>
</button>

<div id="search-menu" class="hidden px-4 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" aria-labelledby="search-menu-label" tabindex="-1" aria-hidden="true">
    <div class="w-full max-w-[640px] flex flex-col gap-8 pt-4 pb-8 items-center align-top bg-[#E9D9C7] rounded-4xl">
        <div class="px-4 w-full">
            <form class="w-full max-w-[608px] flex justify-start items-center gap-4 px-6 py-2 text-white bg-[#907B60] rounded-4xl" action="{{ route('search.show') }}">
                @csrf
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.6 21L13.3 14.7C12.8 15.1 12.225 15.4167 11.575 15.65C10.925 15.8833 10.2333 16 9.5 16C7.68333 16 6.14583 15.3708 4.8875 14.1125C3.62917 12.8542 3 11.3167 3 9.5C3 7.68333 3.62917 6.14583 4.8875 4.8875C6.14583 3.62917 7.68333 3 9.5 3C11.3167 3 12.8542 3.62917 14.1125 4.8875C15.3708 6.14583 16 7.68333 16 9.5C16 10.2333 15.8833 10.925 15.65 11.575C15.4167 12.225 15.1 12.8 14.7 13.3L21 19.6L19.6 21ZM9.5 14C10.75 14 11.8125 13.5625 12.6875 12.6875C13.5625 11.8125 14 10.75 14 9.5C14 8.25 13.5625 7.1875 12.6875 6.3125C11.8125 5.4375 10.75 5 9.5 5C8.25 5 7.1875 5.4375 6.3125 6.3125C5.4375 7.1875 5 8.25 5 9.5C5 10.75 5.4375 11.8125 6.3125 12.6875C7.1875 13.5625 8.25 14 9.5 14Z" fill="white"/>
                </svg>
                <input id="searchBar" type="text" name="q" class="placeholder:text-white bg-[#907B60] w-full border-none focus:outline-none focus:ring-0 focus:shadow-none" placeholder="Cari kategori/topik/ulasan" autofocus>
            </form>
        </div>
        <div class="w-full">
            <div id="recentSearchs">
                @foreach ($recentSearchs as $recentSearch)
                <a href="{{ route('search.show', [ 'q' => $recentSearch] )}}" class="flex gap-8 px-8 py-4 items-center justify-start hover:bg-[#907B60]/50 border-b border-[#535151]/30 text-lg">{{ $recentSearch }}</a>
                @endforeach
            </div>
            <div id="resultsMenu" class="hidden">
                <div class="flex flex-col gap-8">
                    <div id="searchResults"></div>
                    <div class="flex gap-8 px-8 py-4 items-center justify-center font-bold text-lg w-full">
                        <a id="seeAllResults">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        function changeResultType (type) {
            if (type == 'topics') {
                return 'Topik';
            } else if (type == 'categories') {
                return 'Kategori';
            } else if (type == 'reviews') {
                return 'Ulasan';
            }
        }

        const searchBar = $("#searchBar");

        searchBar.on('keyup', function () {
            if (searchBar.val() == "") {
                $("#searchResults").empty();
                $("#resultsMenu").hide();
                $("#recentSearchs").show();
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('search') }}" + "?q=" + encodeURIComponent(searchBar.val()),
                    dataType: "json",
                    success: function (response) {
                        $("#recentSearchs").hide();
                        $("#resultsMenu").show();
                        $("#searchResults").empty();

                        response.search_results.forEach(result => {
                            $("#searchResults").append(`
                                <a href="${result.url}" class="flex gap-8 px-8 py-4 items-center justify-start hover:bg-[#907B60]/50 border-b border-[#535151]/30 text-lg">
                                    <span class="font-bold min-w-[84px]">${changeResultType(result.type)}</span>
                                    <span>${result.title}</span>
                                </a>
                            `);

                        })

                        $("#seeAllResults").attr('href', "{{ route('search.show') }}" + "?q=" + encodeURIComponent(searchBar.val()));
                    },
                });
            }
        });
    });
</script>
@endpush
