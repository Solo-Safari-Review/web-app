<?php

namespace App\Http\Controllers;

use App\Enums\ActionStatus;
use App\Enums\AnswerStatus;
use App\Enums\ReviewStatus;
use App\Models\CategorizedReview;
use App\Models\Category;
use App\Models\Review;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategorizedReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $categoryId = Crypt::decryptString($request->query('category'));
        } catch (\Exception $e) {
            abort(400, 'Invalid category token');
        }

        // Validasi sorting
        $allowedSorts = ['date', 'likes'];
        $allowedSortMethods = ['asc', 'desc'];

        $sort = $request->query('sort');
        if (in_array($sort, $allowedSorts)) {
            $sort = $sort == "date" ? "created_at" : "likes";
        } else {
            $sort = "created_at";
        }

        $sortMethod = strtolower($request->query('sort-method'));
        $sortMethod = in_array($sortMethod, $allowedSortMethods) ? $sortMethod : 'desc';

        $filter = $request->query('filter');
        $categorizedReviews = DB::table('categorized_reviews')
            ->join('reviews', 'categorized_reviews.review_id', '=', 'reviews.id')
            ->where('categorized_reviews.category_id', $categoryId);

        // Filter handling
        if ($filter === "rating" && $request->has('rating')) {
            $categorizedReviews->where('reviews.rating', $request->query('rating'));
        } elseif ($filter === "action-status") {
            $categorizedReviews->where('categorized_reviews.action_status', $request->query('status'));
        } elseif ($filter === "review-status") {
            $categorizedReviews->where('categorized_reviews.review_status', $request->query('status'));
        } elseif ($filter === "answer-status") {
            $categorizedReviews->where('categorized_reviews.answer_status', $request->query('status'));
        }

        $categorizedReviews = $categorizedReviews
            ->orderBy('reviews.' . $sort, $sortMethod)
            ->cursorPaginate(20);

        return response()->json($categorizedReviews);
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
            if ($request->filled('review_id')){$request['review_id'] = Crypt::decryptString($request->review_id);}
            if ($request->filled('category_id')){$request['category_id'] = Crypt::decryptString($request->category_id);}
            if ($request->filled('user_id')){$request['user_id'] = Crypt::decryptString($request->user_id);}

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
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Review categorized successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
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
    public function destroy(CategorizedReview $categorizedReview)
    {
        //
    }
}
