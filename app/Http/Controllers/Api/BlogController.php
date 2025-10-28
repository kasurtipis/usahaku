<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $blogs = Blog::with('category')->paginate(10);
        return response()->json($blogs);
    }

    /**
     * Display blogs by category.
     */
    public function indexByCategory($category): JsonResponse
    {
        $blogs = Blog::where('blog_category_id', $category)
                    ->with('category')
                    ->paginate(10);
        return response()->json($blogs);
    }

    /**
     * Display blogs by author.
     */
    public function indexByAuthor($author): JsonResponse
    {
        $blogs = Blog::where('author', $author)
                    ->with('category')
                    ->paginate(10);
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:blogs',
            'subdomain' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'visitor' => 'nullable|integer',
            'tag' => 'nullable|string|max:255',
        ]);

        $blog = Blog::create($request->all());

        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog): JsonResponse
    {
        $blog->load('category', 'comments');
        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): JsonResponse
    {
        $request->validate([
            'slug' => 'sometimes|string|max:255|unique:blogs,slug,' . $blog->id,
            'subdomain' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'blog_category_id' => 'sometimes|exists:blog_categories,id',
            'author' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'visitor' => 'nullable|integer',
            'tag' => 'nullable|string|max:255',
        ]);

        $blog->update($request->all());

        return response()->json($blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();
        return response()->json(null, 204);
    }
}