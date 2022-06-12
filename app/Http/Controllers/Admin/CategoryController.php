<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return view('admin.category.index', [
            'title' => 'Product Category | Cofftea Administrator',
            'categories' => Category::orderBy('updated_at', 'DESC')->get(),
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', [
            'title' => 'Create New Category | Cofftea Administrator'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'slug' => 'required|unique:categories',
            'description' => 'required|max:255',
            // 'status' => 'required',
            // 'popular' => 'required',
            'image' => 'image|file',
        ]);


        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('category-images');
        }

        // if ($request->status == TRUE) {
        //     $validatedData['status'] = '1';
        // }

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'New Category Has Been Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'title' => 'Edit Category Details | Cofftea Administrator',
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'description' => 'required|max:255',
            // 'status' => 'required',
            // 'popular' => 'required',
            'image' => 'image|file',
        ];

        if ($request->slug != $category->slug || $request->name != $category->name) {
            $rules['slug'] = 'required|unique:categories';
            $rules['name'] = 'required|max:255|unique:categories';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($category->image) {
                Storage::delete($category->image);
            }
            $validatedData['image'] = $request->file('image')->store('category-images');
        }

        Category::where('id', $category->id)
        ->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category Has Been Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::delete($category->image);
        }

        Category::destroy($category->id);

        return redirect('/dashboard/categories')->with('success', 'Category Has Been Deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
