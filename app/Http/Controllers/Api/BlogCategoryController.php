<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = BlogCategory::paginate(10);
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories',
        ]);

        $category = BlogCategory::create($request->all());

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $category): JsonResponse
    {
        $category->load('blogs');
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $category): JsonResponse
    {
        $request->validate([
            'username' => 'sometimes|string|max:255',
            'subdomain' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:blog_categories,slug,' . $category->id,
        ]);

        $category->update($request->all());

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $category): JsonResponse
    {
        $category->delete();
        return response()->json(null, 204);
    }
}