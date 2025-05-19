<div class="xl:hidden">
    <form action="{{ route('categorized-reviews.show', $department) }}" method="GET" class="flex flex-col gap-4 py-4 px-4 bg-[#E9D9C7] rounded-2xl h-fit w-full text-sm">
        <span class="font-bold w-full text-lg">Urutkan</span>
        <div class="flex gap-4 justify-between">
            <div class="flex flex-col gap-4 w-full justify-end">
                <label for="sort" class="font-bold">Berdasarkan</label>
                <select id="sort" name="sort" class="bg-[#907B60] text-white rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                    @foreach ($allowedSorts as $item)
                        <option value="{{ ($item) }}" {{ request('sort') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col gap-4 w-full justify-end">
                <label for="sortMethod" class="font-bold">Dari</label>
                <select id="sortMethod" name="sortMethod" class="bg-[#907B60] text-white rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                    @foreach ($allowedSortMethods as $item)
                        <option value="{{ ($item) }}" {{ request('sortMethod') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <span class="font-bold w-full text-lg">Filter</span>
        <div class="flex gap-4">
            <div id="filterStatusPanel" class="flex flex-col gap-4 justify-between w-full">
                <div class="flex flex-col gap-4 justify-between">
                    <label for="reviewStatus" class="font-bold">Status Review</label>
                    <select name="reviewStatus" class="bg-[#907B60] text-white rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedReviewStatus as $item)
                            <option value="{{ ($item) }}" {{ request('reviewStatus') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-4 justify-between">
                    <label for="actionStatus" class="font-bold">Status Tindakan</label>
                    <select name="actionStatus" class="bg-[#907B60] text-white rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedActionStatus as $item)
                            <option value="{{ ($item) }}" {{ request('actionStatus') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-4 justify-between">
                    <label for="answerStatus" class="font-bold">Status Jawaban</label>
                    <select name="answerStatus" class="bg-[#907B60] text-white rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedAnswerStatus as $item)
                            <option value="{{ ($item) }}" {{ request('answerStatus') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="filterRatingPanel" class="flex flex-col gap-4 justify-between w-full">
                <div class="flex flex-col gap-4 justify-between">
                    <label for="rating" class="font-bold">Rating</label>
                    <select name="rating" class="bg-[#907B60] text-white rounded-lg focus:ring-gray-400 focus:border-gray-400 block w-full p-2.5">
                        <option value="">Tanpa filter</option>
                        @foreach ($allowedRatings as $item)
                            <option value="{{ ($item) }}" {{ request('rating') == $item ? 'selected' : '' }}>{{ $item }} bintang</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="w-full text-center px-2 my-4 py-2 rounded-lg text-white bg-[#907B60] focus:bg-[#907B60]/80">
            Terapkan
        </button>
    </form>
</div>
