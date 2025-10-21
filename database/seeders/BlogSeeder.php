<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Blog::create([
                'slug' => Str::slug("contoh-blog-$i"),
                'username' => 'ilzam',
                'title' => "Contoh Blog ke-$i",
                'blog_category_id' => 1,
                'author' => 'Ilzam Afif',
                'content' => "Ini adalah isi dari blog ke-$i yang dibuat untuk testing.",
                'meta_title' => "Meta Title Blog $i",
                'meta_description' => "Deskripsi singkat untuk blog ke-$i.",
                'visitor' => rand(10, 1000),
                'tag' => 'laravel,php,blog',
            ]);
        }
    }
}
