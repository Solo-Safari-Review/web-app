<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrashController extends Controller
{
    public function index()
    {
        $reviews = Review::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('trash.index', compact('reviews'));
    }

    public function show(Request $request)
    {
        try {
            $reviewId = HashidsHelper::decode($request->route('trash'));
        } catch (\Exception $e) {
            abort(400, 'Invalid review token');
        }

        $review = Review::onlyTrashed()->with('categorizedReview')->find($reviewId);

        return $review;
    }

    public function destroy(Request $request)
    {
        foreach ($request->reviews as $id) {
            try {
                $reviewId = HashidsHelper::decode($id);
            } catch (\Exception $e) {
                abort(400, 'Invalid review token');
            }

            try {
                Review::onlyTrashed()->find($reviewId)->forceDelete();
            } catch (Exception $e) {
                abort(400, 'Review cannot be deleted');
            }
        }

        return redirect()->route('trash.index')->with('success', 'Review(s) deleted successfully');
    }
}
