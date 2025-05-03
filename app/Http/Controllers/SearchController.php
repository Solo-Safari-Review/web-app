<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Topic;
use App\SearchAspects\ReviewSearchAspect;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (Auth::user()->hasRole('Admin Departemen')) {
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

        return response()->json([
            "search_results" => $searchResults,
            "recent_searches" => Cache::get('recent_searches')
        ]);
    }

    public function searchView(Request $request)
    {
        $query = $request->input('q');

        if (Auth::user()->hasRole('Admin Departemen')) {
            $searchResults = (new Search())
                ->registerAspect(ReviewSearchAspect::class)
                ->search($query)
                ->collect();
        } else {
            $searchResults = (new Search())
                ->registerModel(Category::class, ['name'])
                ->registerModel(Topic::class, ['name'])
                ->registerAspect(ReviewSearchAspect::class)
                ->search($query)
                ->collect();
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;

        $searchResults = new LengthAwarePaginator(
            $searchResults->forPage($currentPage, $perPage),
            $searchResults->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        if (!$searchResults->isEmpty()) {
            $recentSearches = Cache::get('recent_searches', []);
            array_unshift($recentSearches, $query);

            $recentSearches = array_unique($recentSearches);
            $recentSearches = array_slice($recentSearches, 0, 5);

            Cache::forever('recent_searches', $recentSearches);
        }

        return view('search.index', [
            'searchResults' => $searchResults,
            'query' => $query
        ]);
    }

    public static function getRecentSearches()
    {
        $recentSearches = Cache::rememberForever('recent_searches', function () {
            return [];
        });

        return $recentSearches;
    }
}
