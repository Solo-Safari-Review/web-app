<?php

namespace App\Http\Controllers;

use App\Enums\ActionStatus;
use App\Enums\AnswerStatus;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Enums\ReviewStatus;
use Exception;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $sort = $request->query('sort');
            $sortMethod = $request->query('sort-method');
            $filter = $request->query('filter');

            if (!$sort || $sort == 'date') {$sort = 'created_at';} else if ($sort == 'likes') {$sort = 'likes';}
            if (!$sortMethod || $sortMethod == 'desc') {$sortMethod = 'desc';} else if ($sortMethod == 'asc') {$sortMethod = 'asc';}
            if (!$filter) {
                $reviews = DB::table('reviews')->orderBy($sort, $sortMethod)->cursorPaginate(20);
            } else {
                if ($filter == "rating") {
                    $rating = $request->query('rating');
                    $reviews = DB::table('reviews')->where('rating', $rating)->orderBy($sort, $sortMethod)->cursorPaginate(20);
                } else {
                    $status = $request->query('status');

                    if ($filter == "action-status") {
                        $reviews = DB::table('reviews')->join('categorized_reviews', 'reviews.id', '=', 'categorized_reviews.review_id')->where('categorized_reviews.action_status', $status)->orderBy($sort, $sortMethod)->cursorPaginate(20);
                    } else if ($filter == "review-status") {
                        $reviews = DB::table('reviews')->join('categorized_reviews', 'reviews.id', '=', 'categorized_reviews.review_id')->where('categorized_reviews.review_status', $status)->orderBy($sort, $sortMethod)->cursorPaginate(20);
                    } else if ($filter == "answer-status") {
                        $reviews = DB::table('reviews')->join('categorized_reviews', 'reviews.id', '=', 'categorized_reviews.review_id')->where('categorized_reviews.answer_status', $status)->orderBy($sort, $sortMethod)->cursorPaginate(20);
                    }
                }
            }

            return $reviews;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $categorizedReview = $review->categorizedReview;
        try {
            $validated = $request->validate([
                'status.review' => [Rule::enum(ReviewStatus::class)],
                'status.action' => [Rule::enum(ActionStatus::class)],
                'status.answer' => [Rule::enum(AnswerStatus::class)],
                'comment.review_admin' => 'nullable|max:65535',
                'comment.department_admin' => 'nullable|max:65535',
            ]);

            if (!empty($validated['status']['review'])) {$categorizedReview->update(['review_status' => $validated['status']['review']]);}
            if (!empty($validated['status']['action'])) {$categorizedReview->update(['action_status' => $validated['status']['action']]);}
            if (!empty($validated['status']['answer'])) {$categorizedReview->update(['answer_status' => $validated['status']['answer']]);}
            if (!empty($validated['comment']['review_admin'])) {$categorizedReview->update(['review_admin_comment' => $validated['comment']['review_admin']]);}
            if (!empty($validated['comment']['department_admin'])) {$categorizedReview->update(['department_admin_comment' => $validated['comment']['department_admin']]);}
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Status updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
