<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $ttl = 5 * 60;
            $categories = Cache::remember('categories', $ttl, function () {
                return Category::withCount('categorizedReviews')->orderBy('categorized_reviews_count', 'desc')->get();
            });

            return $categories;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
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
        if (Auth::user()->hasPermissionTo('make_category')) {
            try {
                $validated = $request->validate([
                    'name' => 'required|unique:categories,name',
                ]);

                Category::create([
                    'name' => $validated['name'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json(['message' => 'Category created successfully'], 200);

            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $categoryId = HashidsHelper::decode($request->route('category'));
            $category = Category::with('categorizedReviews')->find($categoryId);

            return response()->json($category);
        } catch (\Exception $e) {
            abort(400, 'Invalid category token');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $categoryId = HashidsHelper::decode($request->route('category'));
            $category = Category::find($categoryId);

            return response()->json($category);
        } catch (\Exception $e) {
            abort(400, 'Invalid category token');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:categories,name',
            ]);

            $categoryId = HashidsHelper::decode($request->route('category'));
            $category = Category::find($categoryId);

            $category->update([
               'name' => $validated['name'],
            ]);

            return response()->json(['message' => 'Category updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->hasPermissionTo('delete_category')) {
            try {
                $categoryId = HashidsHelper::decode($request->route('category'));
            } catch (\Exception $e) {
                abort(400, 'Invalid category token');
            }

            try {
                Category::find($categoryId)->delete();
            } catch (Exception $e) {
                abort(400, 'Category cannot be deleted');
            }

            return response()->json(['message' => 'Category deleted successfully'], 200);
        }
    }
}
