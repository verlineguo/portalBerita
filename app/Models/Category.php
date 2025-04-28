<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['name', 'slug', 'status'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    // Get active posts in this category
    public function activePosts()
    {
        return $this->posts()->where('status', 1);
    }

    // Check if category is active
    public function isActive()
    {
        return $this->status == 1;
    }
}
