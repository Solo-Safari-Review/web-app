<div class="hidden xl:flex">
    <form action="{{ route('reviews.all') }}" method="GET" class="flex flex-col gap-6 py-4 px-4 border-l rounded-2xl h-fit w-[200px] text-center text-sm">
        <div class="border-b flex flex-col gap-6 pb-4">
            <span class="font-bold text-lg">Urutkan</span>
            <div class="flex flex-col gap-4 w-full text-left">
                <label for="sort" class="font-bold">Berdasarkan</label>
                <select id="sort" name="sort" class="bg-[#F1EADA] rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                    @foreach ($allowedSorts as $item)
                    <option value="{{ ($item) }}" {{ request('sort') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-4 w-full text-left">
                <label for="sortMethod" class="font-bold">Dari</label>
                <select id="sortMethod" name="sortMethod" class="bg-[#F1EADA] rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                    @foreach ($allowedSortMethods as $item)
                    <option value="{{ ($item) }}" {{ request('sortMethod') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="border-b flex flex-col gap-6 pb-4">
            <span class="font-bold text-lg">Filter</span>
            <div id="filterStatusPanel" class="flex flex-col gap-4 justify-between w-full text-left">
                <div class="flex flex-col gap-4 justify-between">
                    <label for="reviewStatus" class="font-bold">Status Review</label>
                    <select name="reviewStatus" class="bg-[#F1EADA] rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedReviewStatus as $item)
                            <option value="{{ ($item) }}" {{ request('reviewStatus') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-4 justify-between">
                    <label for="actionStatus" class="font-bold">Status Tindakan</label>
                    <select name="actionStatus" class="bg-[#F1EADA] rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedActionStatus as $item)
                            <option value="{{ ($item) }}" {{ request('actionStatus') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-4 justify-between">
                    <label for="answerStatus" class="font-bold">Status Jawaban</label>
                    <select name="answerStatus" class="bg-[#F1EADA] rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedAnswerStatus as $item)
                            <option value="{{ ($item) }}" {{ request('answerStatus') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="filterRatingPanel" class="flex flex-col gap-4 justify-between w-full text-left">
                <div class="flex flex-col gap-4 justify-between">
                    <label for="rating" class="font-bold">Rating</label>
                    <select name="rating" class="bg-[#F1EADA] rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedRatings as $item)
                            <option value="{{ ($item) }}" {{ request('rating') == $item ? 'selected' : '' }}>{{ $item }} bintang</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="w-full text-center px-2 my-4 py-2 rounded-lg bg-[#F1EADA] focus:bg-[#F1EADA]/80 border border-gray-400">
            Terapkan
        </button>
    </form>
</div>
