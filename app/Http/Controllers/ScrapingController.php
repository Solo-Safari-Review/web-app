<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScrapingController extends Controller
{
    public function getScrapingData() {
        $reviews = Review::limit(10)->get();
        return view('scraping-reviews.index', compact('reviews'));

        $scrapingUrl = 'http://localhost:8000/run-scraping';

        try {
            $response = Http::timeout(610)->post($scrapingUrl);

            if ($response->successful()) {
                $responseData = $response->json();
                // dd($responseData);
                return view('scraping-reviews.index', compact('responseData'));
            } else {
                return view('scraping-reviews.index')->with(['error' => 'Scraping failed'], 500);
            }
        } catch (\Exception $e) {
            return view('scraping-reviews.index')->with(['error' => 'Scraping failed'], 500);
        }
    }
}
