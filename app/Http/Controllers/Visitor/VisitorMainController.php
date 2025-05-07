<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\CommentNotification;
use App\Notifications\CommentReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class VisitorMainController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();

        // Trending posts (posts with highest views)
        $trendingPosts = Post::where('status', 1)->orderBy('views', 'desc')->take(3)->get();

        // Featured post (top trending post)
        $featuredPost = Post::where('status', 1)->orderBy('views', 'desc')->first();

        // Popular posts (some of the top viewed posts)
        $popularPosts = Post::where('status', 1)
            ->where('id', '!=', $featuredPost->id ?? 0)
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();

        // Right side posts
        $rightSidePosts = Post::where('status', 1)->orderBy('created_at', 'desc')->take(5)->get();

        // Weekly top news (posts from this week)
        $weeklyTopNews = Post::where('status', 1)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();

        // Latest posts for "What's New" section
        $latestPosts = Post::where('status', 1)->orderBy('created_at', 'desc')->take(4)->get();

        // Posts by category for tabs
        $categoryPosts = [];
        foreach ($categories as $category) {
            $categoryPosts[$category->id] = Post::where('status', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->take(4)->get();
        }

        // Weekly2 posts (another set of weekly posts, maybe from previous week)
        $weekly2Posts = Post::where('status', 1)
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Featured video post and video posts
        // Since there's no specific video field in the database, we'll just use regular posts
        // In a real implementation, you might want to add a 'has_video' field to posts table
        $featuredVideoPost = Post::where('status', 1)->orderBy(DB::raw('RAND()'))->first();

        $videoPosts = Post::where('status', 1)
            ->where('id', '!=', $featuredVideoPost->id ?? 0)
            ->orderBy(DB::raw('RAND()'))
            ->take(5)
            ->get();

        // Recent articles
        $recentArticles = Post::where('status', 1)->orderBy('created_at', 'desc')->take(4)->get();

        // Get active advertisement for sidebar
        $advertisement = Advertisement::where('status', 1)->where('position', 'sidebar')->inRandomOrder()->first();

        return view('visitor.page', compact('categories', 'trendingPosts', 'featuredPost', 'popularPosts', 'rightSidePosts', 'weeklyTopNews', 'latestPosts', 'categoryPosts', 'weekly2Posts', 'featuredVideoPost', 'videoPosts', 'recentArticles', 'advertisement'));
    }

    public function show($slug)
    {
        // Get the post with the given slug
        $post = Post::where('slug', $slug)->where('status', 1)->firstOrFail();

        // Increment view count
        $post->views += 1;
        $post->save();

        $trendingPosts = Post::where('status', 1)->orderBy('views', 'desc')->take(3)->get();

        // Get related posts from the same category
        $relatedPosts = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->where('status', 1)->orderBy('created_at', 'desc')->take(3)->get();

        // Get approved comments for this post
        $comments = Comment::where('post_id', $post->id)->where('status', 1)->get();

        // Get categories for sidebar
        $categories = Category::where('status', 1)->get();

        // Get popular posts for sidebar
        $popularPosts = Post::where('status', 1)->orderBy('views', 'desc')->take(5)->get();
        $advertisement = Advertisement::where('status', 1)->where('position', 'footer')->inRandomOrder()->first();

        return view('visitor.details', compact('post', 'relatedPosts', 'comments', 'trendingPosts', 'categories', 'popularPosts','advertisement'));
    }

    public function storeComment(Request $request, $slug)
{
    // Validate request
    $validationRules = [
        'comment' => 'required|string|max:1000',
    ];
    
    // Add validation for parent_id if it exists in the request
    if ($request->has('parent_id')) {
        $validationRules['parent_id'] = 'required|exists:comment,id';
    }
    
    $validated = $request->validate($validationRules);
    
    // Get the post
    $post = Post::where('slug', $slug)->firstOrFail();
    
    // Create comment with all necessary data
    $commentData = [
        'post_id' => $post->id,
        'user_id' => Auth::id(),
        'comment' => $validated['comment'],
        'status' => 0, // Pending approval
    ];
    
    // Add parent_id if this is a reply
    if ($request->has('parent_id')) {
        $commentData['parent_id'] = $validated['parent_id'];
    }
    
    // Create the comment
    $comment = Comment::create($commentData);
    
    // Increment comment count
    $post->comments += 1;
    $post->save();
    
    // Handle notifications for replies
    if ($request->has('parent_id')) {
        $parentComment = Comment::findOrFail($request->parent_id);
        $parentAuthor = User::findOrFail($parentComment->user_id);
        
        // Notify the parent comment author about the reply
        if ($parentAuthor->id !== Auth::id()) {
            $parentAuthor->notify(new CommentReplyNotification($comment, $parentComment));
        }
    }
    
    // Notify the post author about the new comment
    $postAuthor = User::findOrFail($post->writer_id);
    if ($postAuthor->id !== Auth::id()) {
        $postAuthor->notify(new CommentNotification($comment));
    }
    
    // Notify admins about the new comment
    $admins = User::where('role', 0)->get(); // Admin role is 0
    foreach ($admins as $admin) {
        if ($admin->id !== Auth::id()) {
            $admin->notify(new CommentNotification($comment));
        }
    }
    
    return redirect()->back()->with('success', 'Your comment has been submitted and is awaiting approval.');
}


    

    public function about()
    {
        return view('visitor.about'); // Pastikan view ini ada
    }

    public function tagPosts($name)
    {
        $tag = Tag::where('name', $name)->firstOrFail();
        $posts = $tag->posts()->where('status', 1)->paginate(10);
        $categories = Category::where('status', 1)->get();
        $popularPosts = Post::where('status', 1)->orderBy('views', 'desc')->take(5)->get();

        return view('visitor.tag_posts', compact('tag', 'posts', 'categories', 'popularPosts'));
    }

    public function latestNews()
    {
        // Get the latest news (most recent posts)
        $latestPosts = Post::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->get();
        
        // Get trending news (posts with most views)
        $trendingPosts = Post::where('status', 1)
                        ->orderBy('views', 'desc')
                        ->take(5)
                        ->get();
        
        // Get posts by category
        $categories = Category::where('status', 1)->get();
        $postsByCategory = [];
        
        foreach ($categories as $category) {
            $postsByCategory[$category->id] = Post::where('status', 1)
                                            ->where('category_id', $category->id)
                                            ->orderBy('created_at', 'desc')
                                            ->take(4)
                                            ->get();
        }
        
        // Get popular tags
        $popularTags = Tag::where('status', 1)
                        ->take(10)
                        ->get();
        
        // Get sidebar advertisement
        $sidebarAd = Advertisement::where('position', 'sidebar')
                                ->where('status', 1)
                                ->first();
        
        // Get featured post (post with highest view count)
        $featuredPost = Post::where('status', 1)
                        ->orderBy('views', 'desc')
                        ->first();
        
        return view('visitor.latest_news', compact(
            'latestPosts', 
            'trendingPosts', 
            'categories', 
            'postsByCategory', 
            'popularTags',
            'sidebarAd',
            'featuredPost'
        ));
    }
}
