<?php

namespace App\SearchAspects;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Spatie\Searchable\SearchAspect;

class ReviewSearchAspect extends SearchAspect
{
    public function getResults(string $term): \Illuminate\Support\Collection
    {
        if (Auth::user()->hasRole('department_admin')) {
            return Review::query()
                ->join('categorized_reviews', 'reviews.id', '=', 'categorized_reviews.review_id')
                ->where('reviews.username', 'like', "%{$term}%")
                ->orWhere('reviews.content', 'like', "%{$term}%")
                ->where('categorized_reviews.user_id', Auth::user()->id)
                ->orderBy('reviews.created_at', 'desc')
                ->get();
        }

        return Review::query()
            ->where('username', 'like', "%{$term}%")
            ->orWhere('content', 'like', "%{$term}%")
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
