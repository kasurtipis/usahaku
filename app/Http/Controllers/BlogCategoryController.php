<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::orderBy('title')->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:100',
            'subdomain' => 'nullable|string|max:100',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:191|unique:blog_categories',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        $category = BlogCategory::create($validated);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category,
        ]);
    }

    public function show(BlogCategory $blogCategory)
    {
        $blogCategory->load('blogs');
        return response()->json($blogCategory);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:191|unique:blog_categories,slug,' . $blogCategory->id,
        ]);

        $blogCategory->update($validated);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $blogCategory,
        ]);
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
