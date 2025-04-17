<?php

namespace App\Http\Controllers;

use App\Enums\ActionStatus;
use App\Enums\AnswerStatus;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Enums\ReviewStatus;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ttl = 5 * 60;

            if (Auth::user()->hasRole('department_admin')) {
                $recentReviews = Cache::remember('recent_reviews' . Crypt::encryptString(Auth::user()->id), $ttl, function () {
                    return Review::with('categorizedReview')
                        ->whereHas('categorizedReview', function ($query) {
                            $query->where('user_id', Auth::user()->id);
                        })
                        ->orderBy('created_at', 'desc')->limit(5)->get();
                });
                $mostHelpfulReviews = Cache::remember('most_helpful_reviews' . Crypt::encryptString(Auth::user()->id), $ttl, function () {
                    return Review::with('categorizedReview')
                        ->whereHas('categorizedReview', function ($query) {
                            $query->where('user_id', Auth::user()->id);
                        })
                        ->orderBy('likes', 'desc')->limit(5)->get();
                });

                return response()->json([
                    "recent_reviews" => $recentReviews,
                    "most_helpful_reviews" => $mostHelpfulReviews
                ]);
            }

            else {
                $topCategories = Cache::remember('top_categories', $ttl, function () {
                    return Category::withCount('categorizedReviews')->orderBy('categorized_reviews_count', 'desc')->limit(5)->get();
                });
                $recentReviews = Cache::remember('recent_reviews', $ttl, function () {
                    return Review::with('categorizedReview.category')->orderBy('created_at', 'desc')->limit(5)->get();
                });
                $mostHelpfulReviews = Cache::remember('most_helpful_reviews', $ttl, function () {
                    return Review::with('categorizedReview.category')->orderBy('likes', 'desc')->limit(5)->get();
                });

                return response()->json([
                    "topCategories" => $topCategories,
                    "recent_reviews" => $recentReviews,
                    "most_helpful_reviews" => $mostHelpfulReviews
                ]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function allReviews(Request $request)
    {
        try {
            $allowedSorts = ['created_at', 'likes'];
            $allowedSortMethods = ['asc', 'desc'];

            $sort = $request->query('sort');
            $sort = in_array($sort, $allowedSorts) ? $sort : 'created_at';

            $sortMethod = strtolower($request->query('sort-method'));
            $sortMethod = in_array($sortMethod, $allowedSortMethods) ? $sortMethod : 'desc';

            $filter = $request->query('filter');

            if ($request->query('category')) {
                try {
                    $categoryId = Crypt::decryptString($request->query('category'));

                    $query = DB::table('reviews')
                        ->join('categorized_reviews', function ($join) use ($categoryId) {
                            $join
                                ->on('reviews.id', '=', 'categorized_reviews.review_id')
                                ->join('categories', 'categorized_reviews.category_id', '=', 'categories.id')
                                ->where('categorized_reviews.category_id', $categoryId);
                        })
                        ->select([
                            'reviews.*',
                            'categorized_reviews.review_status',
                            'categorized_reviews.action_status',
                            'categorized_reviews.answer_status',
                            'categories.name',
                        ]);
                } catch (\Exception $e) {
                    abort(400, 'Invalid category token');
                }
            } else {
                $query = DB::table('reviews')
                    ->join('categorized_reviews', function ($join) {
                        $join
                            ->on('reviews.id', '=', 'categorized_reviews.review_id')
                            ->join('categories', 'categorized_reviews.category_id', '=', 'categories.id');
                    })
                    ->select([
                        'reviews.*',
                        'categorized_reviews.review_status',
                        'categorized_reviews.action_status',
                        'categorized_reviews.answer_status',
                        'categories.name',
                    ]);
            }


            if (Auth::user()->hasRole('department_admin')) {
                $query->where('categorized_reviews.user_id', Auth::user()->id);
            }

            if ($filter) {
                if ($filter === "rating") {
                    $rating = $request->query('rating');
                    $query->where('rating', $rating);
                } else {
                    if ($filter == 'review-status') {
                        $query->where("categorized_reviews.review_status", $request->query('status'));
                    } elseif ($filter == 'action-status') {
                        $query->where("categorized_reviews.action_status", $request->query('status'));
                    } elseif ($filter == 'answer-status') {
                        $query->where("categorized_reviews.answer_status", $request->query('status'));
                    }
                }
            }

            $reviews = $query->orderBy('reviews.'.$sort, $sortMethod)->cursorPaginate(20);
            return response()->json($reviews);

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
     * Send review to department admin
     */
    public function store(Request $request)
    {
        try {
            if ($request->filled('review_id')) {$request['review_id'] = Crypt::decryptString($request->review_id);}
            if ($request->filled('user_id')) {$request['user_id'] = Crypt::decryptString($request->user_id);}

            $validated = $request->validate([
                'review_id' => [Rule::exists(Review::class, 'id'), 'required'],
                'user_id' => [Rule::exists(User::class, 'id'), 'required'],
                'comment.review_admin' => 'nullable|max:65535',
            ]);

            $review = Review::find($validated['review_id']);

            if ($review->categorizedReview) {
                $review->categorizedReview()->update([
                    'user_id' => $validated['user_id'],
                    'review_admin_comment' => $validated['comment']['review_admin'] ?? null,
                ]);
            } else {
                return response()->json(['error' => 'This review has not been categorized yet'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Status updated successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $reviewId = Crypt::decryptString($request->route('reviews'));
        } catch (\Exception $e) {
            abort(400, 'Invalid review token');
        }

        $review = Review::with('categorizedReview')->find($reviewId);

        return response()->json($review);
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
    public function update(Request $request)
    {
        try {
            $reviewId = Crypt::decryptString($request->route('review'));
            $review = Review::find($reviewId);

            $categorizedReview = $review->categorizedReview;

            if ($request->filled('category_id')) {$request['category_id'] = Crypt::decryptString($request->category_id);}

            $validated = $request->validate([
                'category_id' => [Rule::exists(Category::class, 'id')],
                'status.review' => [Rule::enum(ReviewStatus::class)],
                'status.action' => [Rule::enum(ActionStatus::class)],
                'status.answer' => [Rule::enum(AnswerStatus::class)],
                'comment.review_admin' => 'nullable|max:65535',
                'comment.department_admin' => 'nullable|max:65535',
            ]);

            if (!empty($validated['category_id'])) {$categorizedReview->update(['category_id' => $validated['category_id']]);}
            if (!empty($validated['status']['review'])) {$categorizedReview->update(['review_status' => $validated['status']['review']]);}
            if (!empty($validated['status']['action'])) {$categorizedReview->update(['action_status' => $validated['status']['action']]);}
            if (!empty($validated['status']['answer'])) {$categorizedReview->update(['answer_status' => $validated['status']['answer']]);}
            if (!empty($validated['comment']['review_admin'])) {$categorizedReview->update(['review_admin_comment' => $validated['comment']['review_admin']]);}
            if (!empty($validated['comment']['department_admin'])) {$categorizedReview->update(['department_admin_comment' => $validated['comment']['department_admin']]);}
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Review updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $reviewId = Crypt::decryptString($request->query('review'));
        } catch (\Exception $e) {
            abort(400, 'Invalid review token');
        }

        try {
            Review::find($reviewId)->delete();
        } catch (Exception $e) {
            abort(400, 'Review cannot be deleted');
        }

        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}
