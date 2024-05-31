<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
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

        $products = Product::paginate($paginationLimit);

        $languages = $this->languages;

        return view('admin.product.index',compact('products','languages','paginationLimit'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    public function create()
    {
        $categories = Category::get();
        $languages = $this->languages;

        return view('admin.product.create',compact('categories','languages'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(ProductRequest $request)
    {
        // Define the validation rules
        $validated = $request->validated();
        // Create the product
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();


        if (isset($validated['name']) && is_array($validated['name'])) {
            foreach ($validated['name'] as $locale => $name) {
                ProductTranslation::create([
                    'product_id' => $product->id,
                    'name' => $name,
                    'locale' => $locale,
                    'description' => $validated['description'][$locale] ?? null,
                ]);
            }
        }

        // Save the image if provided
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('product');
        }

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(string $id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(int $id)
    {
       $product = Product::with('media')->findOrFail($id);
       $categories = Category::get();
        $languages = $this->languages;

        return view('admin.product.edit',compact('product','categories','languages'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(ProductRequest $request, int $id)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($id);
        $product->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        foreach ($request->name as $locale => $name) {
            $translation = $product->translations()->firstOrNew(['locale' => $locale]);
            $translation->name = $name;
            $translation->description = $validated['description'][$locale] ?? null;
            $translation->save();
        }


        if ($request->image) {
           $media = Media::where('model_id',$id);
           $media->delete();

            $product->addMediaFromRequest('image')->toMediaCollection('product');
        }

        return redirect()->route('products.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index');
    }


}
