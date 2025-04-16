<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ttl = 5 * 60;
            $topics = Cache::remember('topics', $ttl, function () {
                return Topic::with('reviews')->get();
            });

            return $topics;
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
        try {
            $validated = $request->validate([
                'name' => 'required|unique:topics,name',
            ]);

            Topic::create([
                'name' => $validated['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Category created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $topicId = Crypt::decryptString($request->query('topic'));
        } catch (\Exception $e) {
            abort(400, 'Invalid topic token');
        }

        try {
            Topic::find($topicId)->delete();
        } catch (Exception $e) {
            abort(400, 'Topic cannot be deleted');
        }

        return response()->json(['message' => 'Topic deleted successfully'], 200);
    }
}
