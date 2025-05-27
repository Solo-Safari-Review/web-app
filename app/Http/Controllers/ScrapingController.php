<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ScrapingController extends Controller
{
    public function getScrapingData() {
        $reviews = Cache::remember('scraping_reviews', 3600, function () {
            $scrapingUrl = 'http://localhost:8000/run-scraping';

            try {
                $response = Http::timeout(600)->post($scrapingUrl);

                if ($response->successful()) {
                    $responseData = $response->json();
                    $totalNewReviews = $responseData['data']['total_reviews'];

                } else {
                    return view('scraping-reviews.index')->with(['error' => 'Scraping failed'], 500);
                }
            } catch (\Exception $e) {
                return view('scraping-reviews.index')->with(['error' => 'Scraping failed'], 500);
            }

            $reviews = Review::orderBy('created_at', 'desc')->limit($totalNewReviews)->get();
            $reviews = $reviews->map(function ($review) {
                $review->diff_rating = abs($review->rating - $review->predicted_rating);
                return $review;
            })->sortByDesc('diff_rating');

            return $reviews;
        });

        return view('scraping-reviews.index', compact('reviews'));
    }
}
