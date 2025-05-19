<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\Category;
use App\Models\Topic;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            if (Auth::user()->hasRole('Admin Review')) {
                $categories = Category::with('topics')->withCount('topics')->orderBy('topics_count', 'desc')->paginate(15);
            }

            if (Auth::user()->hasRole('Admin Departemen')) {
                $categories = Category::where('department_id', Auth::user()->department_id)->with('topics')->withCount('topics')->orderBy('topics_count', 'desc')->paginate(15);
            }

            return view('topics.index', compact('categories'));
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
        if (Auth::user()->hasPermissionTo('make_topic')) {
            try {
                $validated = $request->validate([
                    'name' => 'required|unique:topics,name',
                ]);

                Topic::create([
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
            $topicId = HashidsHelper::decode($request->route('topic'));
            $topic = Topic::with('reviews')->find($topicId);

            return response()->json($topic);
        } catch (\Exception $e) {
            abort(400, 'Invalid topic token');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $topicId = HashidsHelper::decode($request->route('topic'));
            $topic = Topic::find($topicId);
            $categories = Category::all();

            return view('topics.edit', compact('topic', 'categories'));
        } catch (\Exception $e) {
            abort(400, 'Invalid topic token');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => '',
        ], [
            'name.required' => 'Nama topik harus diisi',
            'category.required' => 'Kategori harus dipilih',
        ]);

        try {
            $topicId = HashidsHelper::decode($request->route('topic'));
            $topic = Topic::find($topicId);

            $categoryId = HashidsHelper::decode($validated['category']);

            $topic->update([
               'name' => $validated['name'],
               'category_id' => $categoryId,
               'description' => $validated['description'],
            ]);

            return redirect()->route('topics.index')->with('success', 'Topik berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->route('topics.index')->with('error', 'Topik gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->hasPermissionTo('delete_topic')) {
            try {
                $topicId = HashidsHelper::decode($request->route('topic'));
            } catch (\Exception $e) {
                abort(400, 'Invalid topic token');
            }

            try {
                Topic::find($topicId)->delete();
            } catch (Exception $e) {
                abort(400, 'Topic cannot be deleted');
            }

            return redirect()->route('topics.index')->with('success', 'Topik berhasil dihapus');
        }
    }

    public function destroySome(Request $request)
    {
        if (Auth::user()->hasPermissionTo('delete_topic')) {
            foreach ($request->topics as $topic) {
                try {
                    $topicId = HashidsHelper::decode($topic);
                } catch (\Exception $e) {
                    abort(400, 'Topik tidak ditemukan!');
                }

                try {
                    Topic::find($topicId)->delete();
                } catch (Exception $e) {
                    abort(400, 'Gagal menghapus topik!');
                }
            }

            return redirect()->route('topics.index')->with('success', 'Topik yang dipilih berhasil dihapus');
        }
    }
}
