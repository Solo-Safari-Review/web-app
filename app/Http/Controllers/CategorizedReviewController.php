<?php

namespace App\Http\Controllers;

use App\Enums\ActionStatus;
use App\Enums\AnswerStatus;
use App\Enums\ReviewStatus;
use App\Helpers\HashidsHelper;
use App\Models\CategorizedReview;
use App\Models\Department;
use App\Models\Review;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategorizedReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = Department::withCount('categorizedReviews')->paginate(15);

        return view('categorized-reviews.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly categorized review.
     */
    public function store(Request $request)
    {
        try {
            if (Auth::user()->hasPermissionTo('categorizing_review')) {
                if ($request->filled('review_id')){$request['review_id'] = HashidsHelper::decode($request->review_id);}
                if ($request->filled('category_id')){$request['category_id'] = HashidsHelper::decode($request->category_id);}
                if ($request->filled('user_id')){$request['user_id'] = HashidsHelper::decode($request->user_id);}

                $validated = $request->validate([
                    'review_id' => 'required|unique:categorized_reviews,review_id',
                    'category_id' => 'required',
                    'user_id' => [
                        'nullable',
                        Rule::requiredIf(fn () =>
                            data_get($request, 'status.review') === ReviewStatus::Sended->value
                            || data_get($request, 'status.action') === ActionStatus::InProgress->value
                            || data_get($request, 'status.action') === ActionStatus::Finished->value
                        ),
                    ],
                    'status.review' => [Rule::enum(ReviewStatus::class)],
                    'status.action' => [Rule::enum(ActionStatus::class)],
                    'status.answer' => [Rule::enum(AnswerStatus::class)],
                    'comment.review_admin' => 'nullable|max:65535',
                    'comment.department_admin' => 'nullable|max:65535',
                ]);

                CategorizedReview::create([
                    'review_id' => $validated['review_id'],
                    'category_id' => $validated['category_id'],
                    'user_id' => $validated['user_id'] ?? null,
                    'review_status' => $validated['status']['review'] ?? ReviewStatus::Unsended,
                    'action_status' => $validated['status']['action'] ?? ActionStatus::Unfinished,
                    'answer_status' => $validated['status']['answer'] ?? AnswerStatus::Unanswered,
                    'review_admin_comment' => $validated['comment']['review_admin'] ?? null,
                    'department_admin_comment' => $validated['comment']['department_admin'] ?? null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                return response()->json(['message' => 'Review categorized successfully'], 200);
            } else {
                abort(403, 'You do not have permission to categorize a review');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $departmentId = HashidsHelper::decode($request->route('categorized_review'));
        } catch (Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }

        try {
            $allowedSorts = ['Waktu', 'Jumlah Suka'];
            $allowedSortMethods = ['Turun', 'Naik'];
            $allowedReviewStatus = ['Belum diteruskan', 'Sudah diteruskan'];
            $allowedActionStatus = ['Belum dikerjakan', 'Dalam proses', 'Selesai'];
            $allowedAnswerStatus = ['Belum dijawab', 'Sudah dijawab'];
            $allowedRatings = ['5', '4', '3', '2', '1'];


            $sort = $request->query('sort');
            $sort = in_array($sort, $allowedSorts) ? $sort : 'Waktu';
            if ($sort == 'Waktu') {$sort = 'created_at';}
            if ($sort == 'Jumlah Suka') {$sort = 'likes';}

            $sortMethod = $request->query('sort-method');
            $sortMethod = in_array($sortMethod, $allowedSortMethods) ? $sortMethod : 'Turun';
            if ($sortMethod == 'Naik') {$sortMethod = 'asc';}
            if ($sortMethod == 'Turun') {$sortMethod = 'desc';}

            $categoryId = $request->query('category') ? HashidsHelper::decode($request->query('category')) : null;
            $topicId = $request->query('topic') ? HashidsHelper::decode($request->query('topic')) : null;

            $reviews = Review::whereHas('categorizedReview', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->with('categorizedReview', 'topics')->orderBy('reviews.'.$sort, $sortMethod);

            if ($categoryId) {
                $reviews->whereHas('categorizedReview', function ($query) use ($categoryId) {$query->where('category_id', $categoryId);});
            }
            if ($topicId) {
                $reviews->whereHas('topics', function ($query) use ($topicId) {$query->where('topic_id', $topicId);});
            }

            if (in_array($request->query('rating'), $allowedRatings)) {
                $rating = $request->query('rating');
                $reviews->where('rating', $rating);
            }
            if (in_array($request->query('reviewStatus'), $allowedReviewStatus)) {
                $reviews->whereHas('categorizedReview', function ($query) use ($request) {$query->where('review_status', $request->query('reviewStatus'));});
            }
            if (in_array($request->query('actionStatus'), $allowedReviewStatus)) {
                $reviews->whereHas('categorizedReview', function ($query) use ($request) {$query->where('action_status', $request->query('actionStatus'));});
            }
            if (in_array($request->query('answerStatus'), $allowedReviewStatus)) {
                $reviews->whereHas('categorizedReview', function ($query) use ($request) {$query->where('answer_status', $request->query('answerStatus'));});
            }

            $reviews = $reviews->paginate(15);

            return view('categorized-reviews.sended', compact('reviews', 'allowedSorts', 'allowedSortMethods', 'allowedReviewStatus', 'allowedActionStatus', 'allowedAnswerStatus', 'allowedRatings'))->with('department', $request->route('categorized_review'))->with('category', $request->query('category'))->with('topic', $request->query('topic'));
        } catch (\Exception $e) {
            return view('categorized-reviews.sended', compact('reviews', 'allowedSorts', 'allowedSortMethods', 'allowedReviewStatus', 'allowedActionStatus', 'allowedAnswerStatus', 'allowedRatings'))->with('department', $request->route('categorized_review'))->with('category', $request->query('category'))->with('topic', $request->query('topic'))->with('error', 'Terjadi kesalahan pada sistem');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategorizedReview $categorizedReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategorizedReview $categorizedReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
