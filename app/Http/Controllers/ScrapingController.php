<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ScrapingController extends Controller
{
    public function getScrapingData()
    {
        $reviews = Cache::remember('scraping_reviews', 3600, function () {
            $scrapingUrl = 'https://reveazy.site/run-scraping';

            try {
                $response = Http::timeout(360)->get($scrapingUrl);

                if (!$response->successful()) {
                    return [
                        'error' => $response->status(),
                        'message' => 'Failed to fetch scraping data'
                    ]; // Return empty array on failure
                }

                $responseData = $response->json();
                $totalNewReviews = $responseData['total_reviews'] ?? 0;

                if ($totalNewReviews <= 0) {
                    return Cache::get('scraping_reviews', []);
                }

            } catch (\Exception $e) {
                return Cache::get('scraping_reviews', []);
            }

            $reviews = Review::orderBy('created_at', 'desc')->limit($totalNewReviews)->get();

            // Apply transformation & convert to array to avoid closure serialization
            $transformed = $reviews->map(function ($review) {
                $review->diff_rating = abs($review->rating - $review->predicted_rating);
                return $review;
            })->sortByDesc('diff_rating');

            return $transformed;
        });

        return view('scraping-reviews.index', ['reviews' => collect($reviews)]);
    }
}
