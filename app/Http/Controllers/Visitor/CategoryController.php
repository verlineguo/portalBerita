<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::where('status', 1)->get();
        $posts = Post::latest()->paginate(6);
        // Trending posts (posts with highest views)
        $trendingPosts = Post::where('status', 1)
                        ->orderBy('views', 'desc')
                        ->take(3)
                        ->get();

        // Latest posts for "What's New" section
        $latestPosts = Post::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
        
        // Posts by category for tabs
        $categoryPosts = [];
        foreach ($categories as $category) {
            $categoryPosts[$category->id] = Post::where('status', 1)
                                        ->where('category_id', $category->id)
                                        ->orderBy('created_at', 'desc')
                                        ->take(4)
                                        ->get();
        }
        // Get active advertisement for sidebar
        $advertisement = Advertisement::where('status', 1)
                    ->where('position', 'sidebar')
                    ->inRandomOrder()
                    ->first();
        return view('visitor.category', compact('trendingPosts', 'categories', 'latestPosts', 'categoryPosts', 'advertisement'));
    }
    public function show($slug)
    {

        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->latest()->paginate(10);
        return view('visitor.category', compact('posts', 'category'));
    }

}
