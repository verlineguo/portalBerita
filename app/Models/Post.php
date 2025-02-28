<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title', 'meta_keyword', 'meta_description', 'title', 'slug', 'image', 
        'description', 'category_id', 'views', 'comments', 'writer_id', 'status'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke penulis (one-to-many)
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

}
