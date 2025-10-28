<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $comments = BlogComment::with('blog')->paginate(10);
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'username' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'content' => 'required|string',
            'reply' => 'nullable|exists:blog_comments,id',
        ]);

        $comment = BlogComment::create($request->all());

        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogComment $comment): JsonResponse
    {
        $comment->load('blog', 'parent', 'replies');
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogComment $comment): JsonResponse
    {
        $request->validate([
            'blog_id' => 'sometimes|exists:blogs,id',
            'username' => 'sometimes|string|max:255',
            'subdomain' => 'sometimes|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'content' => 'sometimes|string',
            'reply' => 'nullable|exists:blog_comments,id',
        ]);

        $comment->update($request->all());

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogComment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}