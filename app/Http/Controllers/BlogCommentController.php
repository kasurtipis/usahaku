<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index()
    {
        $comments = BlogComment::with(['blog', 'parent', 'replies'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'username' => 'required|string|max:100',
            'subdomain' => 'nullable|string|max:100',
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:150',
            'content' => 'required|string',
            'reply' => 'nullable|exists:blog_comments,id',
        ]);

        $comment = BlogComment::create($validated);

        return response()->json([
            'message' => 'Comment added successfully',
            'data' => $comment,
        ]);
    }

    public function show(BlogComment $blogComment)
    {
        $blogComment->load(['blog', 'replies']);
        return response()->json($blogComment);
    }

    public function update(Request $request, BlogComment $blogComment)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $blogComment->update($validated);

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $blogComment,
        ]);
    }

    public function destroy(BlogComment $blogComment)
    {
        $blogComment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
