<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blog_id',
        'username',
        'subdomain',
        'title',
        'slug',
        'phone',
        'email',
        'content',
        'reply',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'reply');
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'reply');
    }
}
