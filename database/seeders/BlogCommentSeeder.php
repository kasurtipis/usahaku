<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogComment;
use App\Models\Blog;

class BlogCommentSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = Blog::all();

        foreach ($blogs as $blog) {
            for ($i = 1; $i <= 3; $i++) {
                BlogComment::create([
                    'blog_id' => $blog->id,
                    'username' => "user{$i}",
                    'subdomain' => 'blogku',
                    'title' => "Komentar {$i} di blog {$blog->id}",
                    'slug' => "komentar-{$blog->id}-{$i}",
                    'phone' => '08123456789',
                    'email' => "user{$i}@example.com",
                    'content' => "Ini adalah komentar ke-{$i} di blog ID {$blog->id}.",
                ]);
            }
        }
    }
}
