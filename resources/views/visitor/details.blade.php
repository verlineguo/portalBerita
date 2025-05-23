@extends('visitor.layouts.app')

@section('Visitor_page_title')
    {{ $post->title }} - News Portal
@endsection

@section('styles')
    <style>
        .post-tags {
            margin-top: 30px;
        }

        .tag-link {
            display: inline-block;
            padding: 5px 15px;
            margin-right: 8px;
            margin-bottom: 8px;
            background-color: #f0f2f5;
            color: #444;
            border-radius: 20px;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .tag-link:hover {
            background-color: #ff656a;
            color: #fff;
            text-decoration: none;
        }

    .comments-area {
        margin-top: 50px;
    }
    
    .comment-title {
        position: relative;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .comment-title:after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: #ff656a;
    }
    
    .comment-item {
        transition: all 0.3s ease;
    }
    
    .comment-item:hover {
        transform: translateX(5px);
    }
    
    .user-img img {
        border: 3px solid #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    
    .comment-body {
        border-left: 3px solid #ff656a;
    }
    
    .comment-actions a {
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .comment-actions a:hover {
        text-decoration: none;
        opacity: 0.7;
    }
    
    .comment-form textarea {
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }
    
    .comment-form textarea:focus {
        border-color: #ff656a;
        box-shadow: 0 0 0 0.2rem rgba(255, 101, 106, 0.25);
    }
    
    .comment-form button {
        background-color: #ff656a;
        border-color: #ff656a;
        transition: all 0.3s ease;
    }
    
    .comment-form button:hover {
        background-color: #e5595e;
        border-color: #e5595e;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    </style>
@endsection
@section('content')

    <main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                <!-- Hot Aimated News Tittle-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @foreach ($trendingPosts as $trendingItem)
                                        <li class="news-item">{{ $trendingItem->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90 post-details">

                            <div class="about-img">
                                @if ($post->image)
                                    <div class="post-image mb-4">
                                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                                            class="img-fluid">
                                    </div>
                                @else
                                    <div class="post-image mb-4">
                                        <img src="{{ asset('frontend/assets/img/news/whatNews1.jpg') }}"
                                            alt="{{ $post->title }}" class="img-fluid">
                                    </div>
                                @endif
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3>{{ $post->title }}</h3>
                                <div class="post-meta">
                                    <span>{{ $post->category->name }} | </span>
                                    <span>{{ $post->created_at->format('M d, Y') }} | </span>
                                    <span>{{ $post->views }} Views</span>
                                </div>
                            </div>

                            <div class="about-prea">
                                <p class="about-pera1 mb-25 text-justify">{!! $post->description !!}</p>
                            </div>
                            @if ($post->tags->count() > 0)
                                <div class="post-tags mt-4">
                                    <h5>Tags:</h5>
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('tag.posts', $tag->name) }}"
                                            class="tag-link">{{ $tag->name }}</a>
                                    @endforeach
                                </div>


                                <!-- Social share -->
                                <div class="social-share pt-30">
                                    <div class="section-tittle">
                                        <h3 class="mr-20">Share:</h3>
                                        <ul>
                                            <li><a href="#"><img
                                                        src="{{ asset('frontend/assets/img/news/icon-ins.png') }}"
                                                        alt=""></a></li>
                                            <li><a href="#"><img
                                                        src="{{ asset('frontend/assets/img/news/icon-fb.png') }}"
                                                        alt=""></a></li>
                                            <li><a href="#"><img
                                                        src="{{ asset('frontend/assets/img/news/icon-tw.png') }}"
                                                        alt=""></a></li>
                                            <li><a href="#"><img
                                                        src="{{ asset('frontend/assets/img/news/icon-yo.png') }}"
                                                        alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Related posts -->
                                <div class="related-posts mt-5">
                                    <h3>Related Posts</h3>
                                    <div class="row">
                                        @foreach ($relatedPosts as $relatedPost)
                                            <div class="col-md-4 mb-4">
                                                <div class="card h-100">
                                                    <img src="{{ $relatedPost->image ? asset($relatedPost->image) : asset('frontend/assets/img/news/whatNews1.jpg') }}"
                                                        alt="{{ $relatedPost->title }}" class="card-img-top">

                                                    <div class="card-body">
                                                        <h5 class="card-title"><a
                                                                href="{{ route('visitor.post.details', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                                        </h5>
                                                        <p class="card-text">
                                                            {{ Str::limit(strip_tags($relatedPost->description), 100) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                
                            @endif

                            <div class="comments-area mt-5">
                                <h4 class="mb-4 comment-title">{{ $comments->where('status', 1)->count() }} Comments</h4>
                            
                                @foreach ($comments->where('parent_id', null)->where('status', 1) as $comment)
                                    <div class="comment-item mb-4" id="comment-{{ $comment->id }}">
                                        <div class="d-flex">
                                            <div class="user-img mr-3">
                                                <img src="{{ asset('frontend/assets/img/Profile-PNG-Photo.png') }}" alt="" class="rounded-circle" width="60">
                                            </div>
                                            <div class="comment-body bg-light p-3 rounded w-100">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h5 class="mb-0 font-weight-bold">{{ $comment->user->name }}</h5>
                                                    <p class="comment-date text-muted mb-0"><i class="far fa-clock mr-1"></i>{{ $comment->created_at->format('M d, Y') }}</p>
                                                </div>
                                                <div class="comment-text">
                                                    <p class="mb-1">{{ $comment->comment }}</p>
                                                </div>
                                                <div class="comment-actions mt-2">
                                                    <a href="#" class="reply-btn text-primary" data-comment-id="{{ $comment->id }}">
                                                        <i class="far fa-comment mr-1"></i>Reply
                                                    </a>
                                                    <a href="#" class="like-btn text-success ml-3"><i class="far fa-thumbs-up mr-1"></i>Like</a>
                                                </div>
                                                
                                                <!-- Reply form (hidden by default) -->
                                                <div class="reply-form mt-3" id="reply-form-{{ $comment->id }}" style="display: none;">
                                                    @auth
                                                        <form action="{{ route('visitor.post.comment', $post->slug) }}" method="POST" class="bg-white p-3 rounded border">
                                                            @csrf
                                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                            <div class="form-group">
                                                                <textarea name="comment" class="form-control" rows="3" placeholder="Write your reply..."></textarea>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    <i class="far fa-paper-plane mr-1"></i>Post Reply
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-light cancel-reply" data-comment-id="{{ $comment->id }}">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @else
                                                        <div class="bg-light p-2 rounded text-center">
                                                            <p class="mb-0 small">Please <a href="{{ route('login') }}" class="font-weight-bold text-primary">login</a> to reply.</p>
                                                        </div>
                                                    @endauth
                                                </div>
                                                
                                                <!-- Replies to this comment -->
                                                @php
                                                    $approvedReplies = $comment->replies()->where('status', 1)->get();
                                                @endphp
                                                
                                                @if($approvedReplies->count() > 0)
                                                    <div class="replies-container ml-4 mt-3">
                                                        @foreach($approvedReplies as $reply)
                                                            <div class="reply-item mb-3 border-left pl-3">
                                                                <div class="d-flex">
                                                                    <div class="user-img mr-2">
                                                                        <img src="{{ asset('frontend/assets/img/Profile-PNG-Photo.png') }}" alt="" class="rounded-circle" width="40">
                                                                    </div>
                                                                    <div class="reply-body bg-white p-2 rounded w-100">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <h6 class="mb-0 font-weight-bold">{{ $reply->user->name }}</h6>
                                                                            <p class="reply-date text-muted mb-0 small"><i class="far fa-clock mr-1"></i>{{ $reply->created_at->format('M d, Y') }}</p>
                                                                        </div>
                                                                        <div class="reply-text">
                                                                            <p class="mb-1 small">{{ $reply->comment }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            
                                <!-- Pending comments message -->
                                @if(Auth::check() && $comments->where('user_id', Auth::id())->where('status', 0)->count() > 0)
                                    <div class="alert alert-info mb-4">
                                        <p class="mb-0"><i class="fas fa-info-circle mr-2"></i>You have {{ $comments->where('user_id', Auth::id())->where('status', 0)->count() }} pending comment(s) awaiting approval.</p>
                                    </div>
                                @endif
                            
                                <!-- Main comment form -->
                                @auth
                                    <div class="comment-form mt-5">
                                        <h4 class="mb-4">Leave a Comment</h4>
                                        <form action="{{ route('visitor.post.comment', $post->slug) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control p-3" rows="5" placeholder="Share your thoughts about this post..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary px-4 py-2">
                                                <i class="far fa-paper-plane mr-2"></i>Post Comment
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="mt-5 p-4 bg-light rounded text-center">
                                        <p class="mb-0">Please <a href="{{ route('login') }}" class="font-weight-bold text-primary">login</a> to join the discussion and leave a comment.</p>
                                    </div>
                                @endauth
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Advertisement -->
                            @if ($advertisement && $advertisement->status)
                                <div class="news-poster d-none d-lg-block">
                                    <img src="{{ asset($advertisement->image) }}" alt="Advertisement">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">



                        <!-- Popular posts -->
                        <div class="popular-posts-widget mb-5">
                            <h4>Popular Posts</h4>
                            @foreach ($popularPosts as $popularPost)
                                <div class="media mb-3">
                                    <img src="{{ $popularPost->image ? asset('storage/' . $popularPost->image) : asset('frontend/assets/img/news/whatNews1.jpg') }}"
                                        alt="{{ $popularPost->title }}" class="mr-4"style="width: 80px;">
                                    <div class="media-body">
                                        <h6><a
                                                href="{{ route('visitor.post.details', $popularPost->slug) }}">{{ $popularPost->title }}</a>
                                        </h6>
                                        <p class="text-muted">{{ $popularPost->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
            <!-- About US End -->
        </div>
    </main>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Show reply form when Reply button is clicked
        $('.reply-btn').click(function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideDown();
        });
        
        // Hide reply form when Cancel button is clicked
        $('.cancel-reply').click(function(e) {
            e.preventDefault();
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideUp();
        });
    });
</script>
@endsection
