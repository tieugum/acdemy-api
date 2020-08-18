<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return CategoryResource::collection($categories);
    }

    public function findBySlug($slug)
    {
        $category = Category::where('slug', $slug)->with('children')->first();
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:120', 'unique:categories,name'],
            'parent_id' => ['nullable', 'numeric']
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:120', 'unique:categories,name,' . $category->id ],
            'parent_id' => ['nullable', 'numeric']
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => 'Record Deleted.'
        ], 200);
    }
}
