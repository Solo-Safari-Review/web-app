<?php

namespace App\Http\Controllers;

use App\Enums\ActionStatus;
use App\Enums\AnswerStatus;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Enums\ReviewStatus;
use App\Helpers\HashidsHelper;
use App\Models\Category;
use App\Models\Department;
use App\Models\Topic;
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
            $ttl = 60;

            if (Auth::user()->hasRole('Admin Departemen')) {
                $topTopics = Cache::remember('top_topics' . HashidsHelper::encode(Auth::user()->id), $ttl, function () {
                    return Topic::with('reviews')
                        ->whereHas('reviews.categorizedReview', function ($query) {
                            $query->where('department_id', Auth::user()->department_id);
                        })
                        ->withCount('reviews')
                        ->orderBy('reviews_count', 'desc')
                        ->limit(5)
                        ->get();
                });
                $recentReviews = Cache::remember('recent_reviews' . HashidsHelper::encode(Auth::user()->id), $ttl, function () {
                    return Review::with('categorizedReview')
                        ->whereHas('categorizedReview', function ($query) {
                            $query->where('department_id', Auth::user()->department_id);
                        })
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                });
                $mostHelpfulReviews = Cache::remember('most_helpful_reviews' . HashidsHelper::encode(Auth::user()->id), $ttl, function () {
                    return Review::with('categorizedReview')
                        ->whereHas('categorizedReview', function ($query) {
                            $query->where('department_id', Auth::user()->department_id);
                        })
                        ->orderBy('likes', 'desc')
                        ->limit(5)
                        ->get();
                });

                return view('home', [
                    'topTopics' => $topTopics,
                    'recentReviews' => $recentReviews,
                    'mostHelpfulReviews' => $mostHelpfulReviews
                ]);
            }

            else {
                $topTopics = Cache::remember('top_topics', $ttl, function () {
                    return Topic::withCount('reviews')->orderBy('reviews_count', 'desc')->limit(5)->get();
                });
                $topCategories = Cache::remember('top_categories', $ttl, function () {
                    return Category::withCount('categorizedReviews')->orderBy('categorized_reviews_count', 'desc')->limit(5)->get();
                });
                $recentReviews = Cache::remember('recent_reviews', $ttl, function () {
                    return Review::with('categorizedReview.category')->orderBy('created_at', 'desc')->limit(5)->get();
                });
                $mostHelpfulReviews = Cache::remember('most_helpful_reviews', $ttl, function () {
                    return Review::with('categorizedReview.category')->orderBy('likes', 'desc')->limit(5)->get();
                });

                return view('home', [
                    'topTopics' => $topTopics,
                    'topCategories' => $topCategories,
                    'recentReviews' => $recentReviews,
                    'mostHelpfulReviews' => $mostHelpfulReviews
                ]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function allReviews(Request $request)
    {
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

            $reviews = Review::with('categorizedReview', 'topics')->orderBy('reviews.'.$sort, $sortMethod);

            if (Auth::user()->hasRole('Admin Departemen')) {
                $reviews->whereHas('categorizedReview', function ($query) {
                    $query->where('department_id', Auth::user()->department_id);
                });
            }

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

            return view('reviews.all', compact('reviews', 'allowedSorts', 'allowedSortMethods', 'allowedReviewStatus', 'allowedActionStatus', 'allowedAnswerStatus', 'allowedRatings'));
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
        if (Auth::user()->hasPermissionTo('send_review')) {
            try {
                if ($request->filled('review_id')) {$request['review_id'] = HashidsHelper::decode($request->review_id);}
                if ($request->filled('department_id')) {$request['department_id'] = HashidsHelper::decode($request->department_id);}

                $validated = $request->validate([
                    'review_id' => [Rule::exists(Review::class, 'id'), 'required'],
                    'department_id' => [Rule::exists(Department::class, 'id'), 'required'],
                    'comment.review_admin' => 'nullable|max:65535',
                ]);

                $review = Review::find($validated['review_id']);

                if ($review->categorizedReview) {
                    $review->categorizedReview()->update([
                        'department_id' => $validated['department_id'],
                        'review_admin_comment' => $validated['comment']['review_admin'] ?? null,
                    ]);

                    return response()->json(['success' => 'Ulasan berhasil dikirimkan'], 200);
                } else {
                    return response()->json(['error' => 'Ulasan belum terkategorikan'], 500);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            abort(403, 'You do not have permission to send a review');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $reviewId = HashidsHelper::decode($request->route('review'));
        } catch (\Exception $e) {
            abort(400, 'Invalid review token');
        }

        if (Auth::user()->hasRole('Admin Departemen')) {
            $review = Review::with('categorizedReview')
                ->whereHas('categorizedReview', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->find($reviewId);
        } else {
            $review = Review::with('categorizedReview')->find($reviewId);
        }

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
            $reviewId = HashidsHelper::decode($request->route('review'));
            $review = Review::find($reviewId);

            $categorizedReview = $review->categorizedReview;

            if ($request->filled('category_id')) {$request['category_id'] = HashidsHelper::decode($request->category_id);}

            $validated = $request->validate([
                'category_id' => [Rule::exists(Category::class, 'id')],
                'status.review' => [Rule::enum(ReviewStatus::class)],
                'status.action' => [Rule::enum(ActionStatus::class)],
                'status.answer' => [Rule::enum(AnswerStatus::class)],
                'comment.review_admin' => 'nullable|max:65535',
                'comment.department_admin' => 'nullable|max:65535',
            ]);

            if (Auth::user()->hasPermissionTo('categorizing_review')) {
                if (!empty($validated['category_id'])) {$categorizedReview->update(['category_id' => $validated['category_id']]);}
            }
            if (Auth::user()->hasPermissionTo('flagging_review')) {
                if (!empty($validated['status']['review'])) {$categorizedReview->update(['review_status' => $validated['status']['review']]);}
                if (!empty($validated['status']['action'])) {$categorizedReview->update(['action_status' => $validated['status']['action']]);}
                if (!empty($validated['status']['answer'])) {$categorizedReview->update(['answer_status' => $validated['status']['answer']]);}
            }
            if (Auth::user()->hasPermissionTo('comment_review')) {
                if (!empty($validated['comment']['review_admin'])) {$categorizedReview->update(['review_admin_comment' => $validated['comment']['review_admin']]);}
                if (!empty($validated['comment']['department_admin'])) {$categorizedReview->update(['department_admin_comment' => $validated['comment']['department_admin']]);}
            }

            return response()->json(['message' => 'Review updated successfully'], 200);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->hasPermissionTo('delete_review')) {
            try {
                $reviewId = HashidsHelper::decode($request->route('review'));
            } catch (\Exception $e) {
                abort(400, 'Invalid review token');
            }

            try {
                Review::find($reviewId)->delete();
            } catch (Exception $e) {
                abort(400, 'Review cannot be deleted');
            }

            return response()->json(['message' => 'Review deleted successfully'], 200);
        } else {
            abort(403, 'You do not have permission to delete a review');
        }
    }

    public function destroySome(Request $request)
    {
        if (Auth::user()->hasPermissionTo('delete_review')) {
            foreach ($request->reviews as $id) {
                try {
                    $reviewId = HashidsHelper::decode($id);
                } catch (\Exception $e) {
                    abort(400, 'Invalid review token');
                }

                try {
                    Review::find($reviewId)->delete();
                } catch (Exception $e) {
                    abort(400, 'Review cannot be deleted');
                }
            }

            return response()->json(['message' => 'All Reviews deleted successfully'], 200);
        } else {
            abort(403, 'You do not have permission to delete a review');
        }
    }
}
