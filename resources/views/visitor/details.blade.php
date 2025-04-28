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
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
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
                                                    <img src="{{ $relatedPost->image ? asset('storage/' . $relatedPost->image) : asset('frontend/assets/img/news/whatNews1.jpg') }}"
                                                        alt="{{ $relatedPost->title }}" class="card-img-top">

                                                    <div class="card-body">
                                                        <h5 class="card-title"><a
                                                                href="{{ route('post.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
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

                                <!-- Comments -->
                                <div class="comments-area mt-5">
                                    <h3>{{ $comments->count() }} Comments</h3>

                                    @foreach ($comments as $comment)
                                        <div class="comment-item">
                                            <div class="d-flex">
                                                <div class="user-img">
                                                    <img src="{{ asset('frontend/assets/img/comment/user.png') }}"
                                                        alt="">
                                                </div>
                                                <div class="comment-body">
                                                    <h5>{{ $comment->user->name }}</h5>
                                                    <p class="comment-date">{{ $comment->created_at->format('M d, Y') }}
                                                    </p>
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Comment form -->
                                    @auth
                                        <div class="comment-form mt-5">
                                            <h3>Leave a Comment</h3>
                                            <form action="{{ route('visitor.post.comment', $post->slug) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="comment" class="form-control" rows="5" placeholder="Your Comment"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Comment</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="mt-5">
                                            <p>Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                                        </div>
                                    @endauth
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <!-- Advertisement -->
                            @if ($advertisement && $advertisement->status)
                                <div class="news-poster d-none d-lg-block">
                                    <img src="{{ asset('storage/' . $advertisement->image) }}" alt="Advertisement">
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
