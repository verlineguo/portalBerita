<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $posts = Post::latest()->paginate(6);
        // Trending posts (posts with highest views)
        $trendingPosts = Post::where('status', 1)
                        ->orderBy('views', 'desc')
                        ->take(3)
                        ->get();

        
        return view('visitor.about', compact('trendingPosts'));
    }
}
