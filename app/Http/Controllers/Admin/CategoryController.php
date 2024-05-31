<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CategoryController extends Controller
{


    public function __construct()
    {
        $this->languages = LaravelLocalization::getSupportedLocales();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $defaultPaginationLimit = 10;

        $paginationLimit = $request->query('pagination_limit', $defaultPaginationLimit);

        $categories = Category::paginate($paginationLimit);

        return view('admin.category.index', compact('categories', 'paginationLimit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages= $this->languages;
        return view('admin.category.create',compact('languages'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $validated = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
        ]);
        \DB::beginTransaction();
        try {
            $category = Category::create([]);

            foreach ($validated['name'] as $locale => $name) {
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'name' => $name,
                    'locale' => $locale,
                ]);
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 0, 'errors' => $e->getMessage()]);
        }

        \DB::commit();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
       $category = Category::findOrFail($id);
        $languages= $this->languages;
        return view('admin.category.edit',compact('category','languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        $category = Category::findOrFail($id);

        foreach ($request->name as $locale => $name) {
            $translation = $category->translations()->firstOrNew(['locale' => $locale]);
            $translation->name = $name;
            $translation->save();
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index');
    }
}
