<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Topic;
use App\SearchAspects\ReviewSearchAspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (Auth::user()->hasRole('department_admin')) {
            $searchResults = (new Search())
                ->registerAspect(ReviewSearchAspect::class)
                ->search($query)
                ->take(5);
        } else {
            $searchResults = (new Search())
                ->registerModel(Category::class, ['name'])
                ->registerModel(Topic::class, ['name'])
                ->registerAspect(ReviewSearchAspect::class)
                ->search($query)
                ->take(5);
        }

        if (!$searchResults->isEmpty()) {
            $recentSearches = Cache::get('recent_searches', []);
            array_unshift($recentSearches, $query);

            $recentSearches = array_unique($recentSearches);
            $recentSearches = array_slice($recentSearches, 0, 5);

            Cache::forever('recent_searches', $recentSearches);
        }

        return response()->json([
            "search_results" => $searchResults,
            "recent_searches" => Cache::get('recent_searches')
        ]);
    }

    public function searchView(Request $request)
    {

    }

    public function getRecentSearches(Request $request)
    {
        $recentSearches = Cache::rememberForever('recent_searches', function () {
            return [];
        });

        return $recentSearches;
    }
}
