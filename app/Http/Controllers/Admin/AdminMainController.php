<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Newsletter;
use App\Models\Contact;
use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminMainController extends Controller
{
    public function index()
    {
        // Get counts for cards at the top
        $totalPosts = Post::count();
        $totalCategories = Category::count();
        $totalComments = Comment::count();
        $totalUsers = User::count();

        // Calculate percentage increases
        $lastWeekPosts = Post::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $previousWeekPosts = Post::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])->count();
        $newPostsPercentage = $previousWeekPosts > 0 ? round(($lastWeekPosts - $previousWeekPosts) / $previousWeekPosts * 100) : 0;
        
        $lastWeekCategories = Category::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $previousWeekCategories = Category::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])->count();
        $newCategoriesPercentage = $previousWeekCategories > 0 ? round(($lastWeekCategories - $previousWeekCategories) / $previousWeekCategories * 100) : 0;
        
        $lastWeekComments = Comment::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $previousWeekComments = Comment::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])->count();
        $newCommentsPercentage = $previousWeekComments > 0 ? round(($lastWeekComments - $previousWeekComments) / $previousWeekComments * 100) : 0;
        
        $lastWeekUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $previousWeekUsers = User::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])->count();
        $newUsersPercentage = $previousWeekUsers > 0 ? round(($lastWeekUsers - $previousWeekUsers) / $previousWeekUsers * 100) : 0;

        // Get statistics for charts
        // Post activity overview chart
        $activityLabels = [];
        $postsData = [];
        $viewsData = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);
            $activityLabels[] = $day->format('D');
            
            $postsData[] = Post::whereDate('created_at', $day->format('Y-m-d'))->count();
            $viewsData[] = Post::whereDate('created_at', $day->format('Y-m-d'))->sum('views');
        }

        // Popular categories chart
        $popularCategories = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        $categoryNames = $popularCategories->pluck('name')->toArray();
        $categoryPostCounts = $popularCategories->pluck('posts_count')->toArray();

        // Get recent posts for table
        $recentPosts = Post::with(['category', 'writer'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Get recent comments for table
        $recentComments = Comment::with(['user', 'post'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Card statistics
        $totalViews = Post::sum('views');
        $previousTotalViews = Post::where('created_at', '<', Carbon::now()->subDays(7))->sum('views');
        $viewsPercentage = $previousTotalViews > 0 ? round((($totalViews - $previousTotalViews) / $previousTotalViews) * 100) : 0;

        // Average time on site (sample calculation - update with your tracking logic)
        $avgTimeOnSite = "2m 45s"; // Placeholder value - implement your own calculation
        $timeOnSitePercentage = 5; // Placeholder value - implement your own calculation

        // Comments per post
        $commentsPerPost = $totalPosts > 0 ? round($totalComments / $totalPosts, 1) : 0;
        $previousCommentsPerPost = 0;
        if ($totalPosts > 0) {
            $previousCommentsPerPost = Comment::where('created_at', '<', Carbon::now()->subDays(7))->count() / 
                Post::where('created_at', '<', Carbon::now()->subDays(7))->count();
        }
        $commentsPercentage = $previousCommentsPerPost > 0 ? round((($commentsPerPost - $previousCommentsPerPost) / $previousCommentsPerPost) * 100) : 0;

        // Newsletter subscribers
        $newsletterCount = Newsletter::count();
        $previousNewsletterCount = Newsletter::where('created_at', '<', Carbon::now()->subDays(7))->count();
        $newsletterPercentage = $previousNewsletterCount > 0 ? round((($newsletterCount - $previousNewsletterCount) / $previousNewsletterCount) * 100) : 0;

        // Contact messages
        $contactCount = Contact::count();
        $previousContactCount = Contact::where('created_at', '<', Carbon::now()->subDays(7))->count();
        $contactPercentage = $previousContactCount > 0 ? round((($contactCount - $previousContactCount) / $previousContactCount) * 100) : 0;

        // Advertisements
        $adCount = Advertisement::where('status', 1)->count();
        $previousAdCount = Advertisement::where('status', 1)->where('created_at', '<', Carbon::now()->subDays(7))->count();
        $adPercentage = $previousAdCount > 0 ? round((($adCount - $previousAdCount) / $previousAdCount) * 100) : 0;

        // User distribution
        $adminCount = User::where('role', 0)->count();
        $writerCount = User::where('role', 1)->count();
        $regularCount = User::where('role', 2)->count();

        // Content status
        $publishedCount = Post::where('status', 1)->count();
        $draftCount = Post::where('status', 0)->count();
        $pendingCommentCount = Comment::where('status', 0)->count();

        // Top writers
        $topWriters = User::where('role', 1)
            ->withCount('posts')
            ->withCount(['posts as total_comments' => function($query) {
                $query->select(DB::raw('SUM(comments)'));
            }])
            ->withCount(['posts as total_views' => function($query) {
                $query->select(DB::raw('SUM(views)'));
            }])
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPosts', 'totalCategories', 'totalComments', 'totalUsers',
            'newPostsPercentage', 'newCategoriesPercentage', 'newCommentsPercentage', 'newUsersPercentage',
            'activityLabels', 'postsData', 'viewsData',
            'popularCategories', 'categoryNames', 'categoryPostCounts',
            'recentPosts', 'recentComments',
            'totalViews', 'viewsPercentage', 'avgTimeOnSite', 'timeOnSitePercentage',
            'commentsPerPost', 'commentsPercentage',
            'newsletterCount', 'newsletterPercentage', 'contactCount', 'contactPercentage',
            'adCount', 'adPercentage',
            'adminCount', 'writerCount', 'regularCount',
            'publishedCount', 'draftCount', 'pendingCommentCount',
            'topWriters'
        ));
    }
    public function setting()
    {
        return view('admin.settings');
    } 

}
