<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'profile_picture', 'status'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'writer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function isAdmin()
    {
        return $this->role === 0;
    }

    public function isWriter()
    {
        return $this->role === 1;
    }

    public function isVisitor()
    {
        return $this->role === 2;
    }
    // User.php
public function getRoleNameAttribute()
{
    return ['admin', 'writer', 'visitor'][$this->role] ?? 'visitor';
}

}

