<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'subdomain',
        'username',
        'title',
        'blog_category_id',
        'author',
        'content',
        'meta_title',
        'meta_description',
        'visitor',
        'tag',
        'blog_comment_id',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    // Relasi ke komentar
    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}
