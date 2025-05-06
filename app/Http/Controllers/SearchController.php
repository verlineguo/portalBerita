<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Handle dashboard search requests
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboardSearch(Request $request)
    {
        $query = $request->input('query');
        
        // Return empty if no query
        if (!$query || strlen($query) < 2) {
            return response()->json([
                'posts' => [],
                'categories' => [],
                'tags' => [],
                'users' => []
            ]);
        }
        
        // Search posts
        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->select('id', 'title', 'image', 'category_id', 'status')
            ->limit(5)
            ->get();
            
        // Add category name to posts
        foreach ($posts as $post) {
            $category = Category::find($post->category_id);
            $post->category_name = $category ? $category->name : '';
        }
        
        // Search categories
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'status')
            ->limit(5)
            ->get();
            
        // Search tags
        $tags = DB::table('tags')
            ->where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'status')
            ->limit(5)
            ->get();
            
        // Search users
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'email', 'profile_picture', 'status')
            ->limit(5)
            ->get();
            
        return response()->json([
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'users' => $users
        ]);
    }
}