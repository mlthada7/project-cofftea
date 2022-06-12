<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index', [
            'title' => 'Product List | Cofftea Administrator',
            'products' => Product::orderBy('created_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'title' => 'Add New Product | Cofftea Administrator',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:products',
            'category_id' => 'required',
            'description' => 'required|string|max:400',
            'original_price' => 'nullable|numeric',
            'selling_price' => 'required|numeric',
            'qty' => 'required|numeric',
            // 'status' => 'required',
            // 'popular' => 'required',
            'image' => 'image|file',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New Product Has Been Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.view', [
            'title' => 'Product Details | Cofftea Administrator',
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Edit Product Details | Cofftea Administrator',
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required|string|max:400',
            'original_price' => 'nullable|numeric',
            'selling_price' => 'required|numeric',
            'qty' => 'required|numeric',
            // 'status' => 'required',
            // 'popular' => 'required',
            'image' => 'image|file',
        ];

        if ($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $product->id)
                ->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'Product Has Been Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'Product Has Been Deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
