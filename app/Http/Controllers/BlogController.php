<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($blogs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'nullable|string|max:191|unique:blogs',
            'subdomain' => 'nullable|string|max:100',
            'username' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'author' => 'required|string|max:100',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['visitor'] = 0;

        $blog = Blog::create($validated);

        return response()->json([
            'message' => 'Blog created successfully',
            'data' => $blog,
        ]);
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'comments']);
        return response()->json($blog);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'slug' => 'nullable|string|max:191|unique:blogs,slug,' . $blog->id,
            'title' => 'nullable|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'author' => 'nullable|string|max:100',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
        ]);

        $blog->update($validated);

        return response()->json([
            'message' => 'Blog updated successfully',
            'data' => $blog,
        ]);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
