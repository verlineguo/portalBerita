<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';


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
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relationship with User (Writer)
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    // Relationship with Tags (Many to Many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    // Relationship with Comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    // Increment view count
    public function incrementViewCount()
    {
        $this->views++;
        return $this->save();
    }
    protected $casts = [
        'status' => 'boolean',
    ];
    

    // Get approved comments
    public function approvedComments()
    {
        return $this->comments()->where('status', 1);
    }

    // Check if post is published (status = 1)
    public function isPublished()
    {
        return $this->status == 1;
    }

    public function commentsList()
    {
        return $this->hasMany(Comment::class);
    }

}
