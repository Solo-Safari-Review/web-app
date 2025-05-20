<form id="edit-form" action="{{ route('reviews.update', \App\Helpers\HashidsHelper::encode($review->id)) }}" method="POST" class="flex flex-col xl:flex-row gap-8 w-full">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-4 w-full">
            <div class="flex gap-4 items-center w-full">
                <span class="grow py-1 text-2xl font-semibold">Detail Ulasan</span>
                <button type="button" id="delete-selected-all" class="text-center text-sm px-6 py-1 rounded-lg bg-[#FFE4B7] border-1 border-gray-300 hover:bg-[#FFE4B7]/80" onclick="confirm('edit-form', 'Ubah Data Review', 'Apakah Anda yakin data yang dimasukkan sudah sesuai?')">Simpan Ulasan</button>
            </div>
            <div class="flex flex-col w-full gap-4 py-1">
                <div class="flex flex-wrap xl:flex-nowrap w-full gap-8 py-2.5">
                    <div class="flex flex-col w-full gap-4">
                        <label for="category" class="xl:text-lg text-sm font-bold">Kategori</label>
                        <select name="category" id="category" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>
                            @foreach ($categories as $category)
                                <option value="{{ \App\Helpers\HashidsHelper::encode($category->id) }}" {{ $review->categorizedReview && $review->categorizedReview->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <label for="department" class="xl:text-lg text-sm font-bold">Departemen</label>
                        <select name="department" id="department" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>
                            @foreach ($departments as $department)
                                <option value="{{ \App\Helpers\HashidsHelper::encode($department->id) }}" {{ $review->categorizedReview && $review->categorizedReview->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-wrap xl:flex-nowrap w-full gap-8 py-2.5">
                    <div class="flex flex-col w-full gap-4">
                        <label for="date" class="xl:text-lg text-sm font-bold">Tanggal Ulasan</label>
                        <input type="text" name="date" id="date" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" value="{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}" disabled>
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <label for="status" class="xl:text-lg text-sm font-bold">Status</label>
                        <div class="flex gap-4 flex-wrap xl:flex-nowrap w-full">
                            <select name="status[review]" id="reviewStatus" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60] w-full" disabled>
                                @foreach ($reviewStatus as $status)
                                    <option value="{{ $status }}" {{ $review->categorizedReview && $review->categorizedReview->review_status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="status[action]" id="actionStatus" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60] w-full">
                                @foreach ($actionStatus as $status)
                                    <option value="{{ $status }}" {{ $review->categorizedReview && $review->categorizedReview->action_status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="status[answer]" id="answerStatus" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60] w-full" disabled>
                                @foreach ($answerStatus as $status)
                                    <option value="{{ $status }}" {{ $review->categorizedReview && $review->categorizedReview->answer_status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap xl:flex-nowrap w-full gap-8 py-2.5">
                    <div class="flex flex-col w-full gap-4">
                        <label for="adminReviewComment" class="xl:text-lg text-sm font-bold">Komentar Admin Review</label>
                        <textarea rows="2" name="comment[review_admin]" id="adminReviewComment" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>{{ $review->categorizedReview->review_admin_comment ?? 'Belum dikomentari' }}</textarea>
                    </div>
                    <div class="flex flex-col w-full gap-4">
                        <label for="adminDepartmentComment" class="xl:text-lg text-sm font-bold">Komentar Admin Departemen</label>
                        <textarea rows="2" name="comment[department_admin]" id="adminDepartmentComment" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]">{{ $review->categorizedReview->department_admin_comment ?? 'Belum dikomentari' }}</textarea>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-4">
                    <div class="flex flex-wrap xl:flex-nowrap gap-4 justify-between">
                        <label for="review" class="xl:text-lg text-sm font-bold">Ulasan oleh {{ $review->username }}</label>
                        <div class="flex gap-4">
                            <label for="rating" class="xl:text-lg text-sm font-bold">Rating: </label>
                            <x-badges.badge-rating-review rating="{{ $review->rating }}"></x-badges.badge-rating-review>
                        </div>
                    </div>
                    <textarea rows="8" name="review" id="review" class="bg-[#D9D9D9] rounded-2xl px-4 py-2 border-0 focus:border-[#907B60] focus:ring-[#907B60]" disabled>{{ $review->content }}</textarea>
                </div>
            </div>
        </div>
    </form>
