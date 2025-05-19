<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\Category;
use App\Models\Department;
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
            $categories = Category::withCount('categorizedReviews')->orderBy('categorized_reviews_count', 'desc')->paginate(15);

            return view('categories.index', compact('categories'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('name', '!=', 'Admin Review')->get();

        return view('categories.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasPermissionTo('make_category')) {
            $validated = $request->validate([
                'name' => 'required|unique:categories,name',
                'department' => 'required',
                'description' => '',
            ], [
                'name.required' => 'Nama kategori harus diisi',
                'name.unique' => 'Kategori sudah ada',
                'department' => 'Departemen harus dipilih'
            ]);

            try {
                $departmentId = HashidsHelper::decode($validated['department']);

                Category::create([
                    'name' => $validated['name'],
                    'department_id' => $departmentId,
                    'description' => $validated['description'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat');
            } catch (Exception $e) {
                dd($e);
                return redirect()->route('categories.index')->with('error', 'Kategori gagal dibuat');
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
            $departments = Department::where('name', '!=', 'Admin Review')->get();

            return view('categories.edit', compact('category', 'departments'));
        } catch (\Exception $e) {
            abort(400, 'Invalid category token');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name',
            'department' => 'required',
            'description' => '',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Kategori sudah ada',
            'department.required' => 'Departemen harus dipilih'
        ]);

        try {
            $categoryId = HashidsHelper::decode($request->route('category'));
            $category = Category::find($categoryId);

            $departmentId = HashidsHelper::decode($validated['department']);

            $category->update([
                'name' => $validated['name'],
                'department_id' => $departmentId,
                'description' => $validated['description'],
            ]);

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Kategori gagal diperbarui');
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

            return redirect()->route('categories.index')->with('success', 'Kategori yang dipilih berhasil dihapus');
        }
    }

    public function destroySome(Request $request)
    {
        if (Auth::user()->hasPermissionTo('delete_category')) {
            foreach ($request->categories as $category) {
                try {
                    $categoryId = HashidsHelper::decode($category);
                } catch (\Exception $e) {
                    abort(400, 'Kategori tidak ditemukan!');
                }

                try {
                    Category::find($categoryId)->delete();
                } catch (Exception $e) {
                    abort(400, 'Gagal menghapus kategori!');
                }
            }

            return redirect()->route('categories.index')->with('success', 'Kategori yang dipilih berhasil dihapus');
        }
    }
}
