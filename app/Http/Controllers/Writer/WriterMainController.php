<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WriterMainController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $now = Carbon::now();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        // Stats for personal stats cards
        $totalPosts = Post::where('writer_id', $user_id)->count();
        $totalViews = Post::where('writer_id', $user_id)->sum('views');
        $totalComments = Post::where('writer_id', $user_id)->sum('comments');
        $draftCount = Post::where('writer_id', $user_id)->where('status', 0)->count();

        // Get new posts percentage (this week vs last week)
        $postsThisWeek = Post::where('writer_id', $user_id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $postsLastWeek = Post::where('writer_id', $user_id)
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->count();

        $newPostsPercentage = $postsLastWeek > 0 ? round((($postsThisWeek - $postsLastWeek) / $postsLastWeek) * 100) : ($postsThisWeek > 0 ? 100 : 0);

        // Get views percentage increase
        $viewsThisWeek = Post::where('writer_id', $user_id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('views');

        $viewsLastWeek = Post::where('writer_id', $user_id)
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('views');

        $viewsPercentage = $viewsLastWeek > 0 ? round((($viewsThisWeek - $viewsLastWeek) / $viewsLastWeek) * 100) : ($viewsThisWeek > 0 ? 100 : 0);

        // Get comments percentage increase
        $commentsThisWeek = Comment::whereIn('post_id', function ($query) use ($user_id) {
            $query->select('id')->from('post')->where('writer_id', $user_id);
        })
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $commentsLastWeek = Comment::whereIn('post_id', function ($query) use ($user_id) {
            $query->select('id')->from('post')->where('writer_id', $user_id);
        })
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->count();

        $commentsPercentage = $commentsLastWeek > 0 ? round((($commentsThisWeek - $commentsLastWeek) / $commentsLastWeek) * 100) : ($commentsThisWeek > 0 ? 100 : 0);

        // Draft posts message
        $draftsMessage = $draftCount > 0 ? $draftCount . ' drafts pending' : 'No drafts';

        // Performance chart data (last 7 days)
        $performanceLabels = [];
        $viewsData = [];
        $commentsData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $performanceLabels[] = $date->format('d M');

            $dailyViews = Post::where('writer_id', $user_id)->whereDate('created_at', '<=', $date)->sum('views');
            $viewsData[] = $dailyViews;

            $dailyComments = Comment::whereIn('post_id', function ($query) use ($user_id, $date) {
                $query->select('id')->from('post')->where('writer_id', $user_id)->whereDate('created_at', '<=', $date);
            })
                ->whereDate('created_at', $date)
                ->count();
            $commentsData[] = $dailyComments;
        }

        // Category distribution data
        $myCategories = Category::withCount([
            'posts' => function ($query) use ($user_id) {
                $query->where('writer_id', $user_id);
            },
        ])
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->limit(5)
            ->get();

        $myCategoryNames = $myCategories->pluck('name')->toArray();
        $myCategoryPostCounts = $myCategories->pluck('posts_count')->toArray();

        // Average calculations
        $avgViewsPerPost = $totalPosts > 0 ? round($totalViews / $totalPosts) : 0;
        $avgCommentsPerPost = $totalPosts > 0 ? round($totalComments / $totalPosts) : 0;

        // Recent posts
        $recentPosts = Post::where('writer_id', $user_id)->with('category')->orderBy('created_at', 'desc')->limit(5)->get();

        // Recent comments on writer's posts
        $recentComments = Comment::whereIn('post_id', function ($query) use ($user_id) {
            $query->select('id')->from('post')->where('writer_id', $user_id);
        })
            ->with(['user', 'post'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('writer.dashboard', compact('totalPosts', 'totalViews', 'totalComments', 'draftCount', 'newPostsPercentage', 'viewsPercentage', 'commentsPercentage', 'draftsMessage', 'performanceLabels', 'viewsData', 'commentsData', 'myCategories', 'myCategoryNames', 'myCategoryPostCounts', 'avgViewsPerPost', 'avgCommentsPerPost', 'recentPosts', 'recentComments'));
    }
}
