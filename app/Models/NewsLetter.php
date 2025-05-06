<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    
    protected $table = 'newsletter';

    protected $fillable = ['email', 'status'];

    public function isActive()
    {
        return $this->status == 1;
    }

    protected $casts = [
        'status' => 'boolean',
    ];
    
    
}
