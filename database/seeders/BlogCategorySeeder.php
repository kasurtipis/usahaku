<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Teknologi', 'Lifestyle', 'Edukasi', 'Kuliner', 'Olahraga'];

        foreach ($categories as $title) {
            BlogCategory::create([
                'username' => 'ilzam',
                'subdomain' => 'blogku',
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        }
    }
}
