<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    use HasFactory;

    protected $table = 'comment';
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
        'status',
        'parent_id',
        
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Rejected'
        ];
        
        return $statuses[$this->status] ?? 'Unknown';
    }
    
}
