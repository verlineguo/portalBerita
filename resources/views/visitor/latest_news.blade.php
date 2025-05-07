@extends('visitor.layouts.app')

@section('styles')
    <style>
        /* Custom CSS for Latest News Page */

        /* Tag styling */
        .tag-link {
            display: inline-block;
            background: #f0f2f8;
            color: #505050;
            padding: 8px 15px;
            margin-right: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tag-link:hover {
            background: #1ebbf0;
            color: #fff;
            text-decoration: none;
        }

        /* Post meta styling */
        .post-meta {
            margin-top: 10px;
            font-size: 13px;
            color: #777;
        }

        .post-meta span {
            margin-right: 15px;
        }

        .post-meta i {
            margin-right: 5px;
        }

        /* Category label styling */
        .color1 {
            background: #1ebbf0;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Featured post styling */
        .trend-top-img {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            max-height: 500px;
        }

        .trend-top-img img {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .trend-top-img:hover img {
            transform: scale(1.05);
        }

        .trend-top-cap {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));
        }

        .trend-top-cap h2 a {
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
        }

        .trend-top-cap p {
            color: #ddd;
        }

        .bgr {
            background-color: #1ebbf0;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Single news item styling */
        .single-what-news {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .single-what-news:hover {
            transform: translateY(-5px);
        }

        .what-img {
            overflow: hidden;
            height: 200px;
        }

        .what-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .single-what-news:hover .what-img img {
            transform: scale(1.1);
        }

        .what-cap {
            padding: 20px;
            background: #fff;
        }

        .what-cap h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .what-cap h4 a {
            color: #000;
            transition: color 0.3s ease;
        }

        .what-cap h4 a:hover {
            color: #1ebbf0;
            text-decoration: none;
        }

        /* Category news styling */
        .weekly-news-active {
            display: flex;
            overflow-x: auto;
            padding-bottom: 20px;
        }

        .weekly-single {
            min-width: 270px;
            margin-right: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            overflow: hidden;
        }

        .weekly-img {
            height: 180px;
            overflow: hidden;
        }

        .weekly-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .weekly-single:hover .weekly-img img {
            transform: scale(1.1);
        }

        .weekly-caption {
            padding: 15px;
            background: #fff;
        }

        .weekly-caption h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .weekly-caption h4 a {
            color: #000;
            transition: color 0.3s ease;
        }

        .weekly-caption h4 a:hover {
            color: #1ebbf0;
            text-decoration: none;
        }

        .weekly-caption p {
            font-size: 12px;
            color: #777;
        }

        

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .trend-top-cap h2 a {
                font-size: 24px;
            }

            .search-box {
                flex-direction: column;
            }

            .input-form,
            .search-form {
                width: 100%;
            }

            .search-form button {
                border-radius: 5px;
                margin-top: 10px;
            }

            .input-form input {
                border-radius: 5px;
            }
        }

        /* Animation for trending news ticker */
        @keyframes ticker {
            0% {
                transform: translateY(0);
            }

            20% {
                transform: translateY(-30px);
            }

            40% {
                transform: translateY(-60px);
            }

            60% {
                transform: translateY(-90px);
            }

            80% {
                transform: translateY(-120px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .trending-animated {
            height: 30px;
            overflow: hidden;
        }

        #js-news {
            animation: ticker 15s infinite;
        }

        .news-item {
            height: 30px;
            padding: 5px 0;
        }
    </style>
@endsection
@section('content')
    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix">
            <div class="container">
                <div class="trending-main">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Trending Top -->
                            <div class="trending-top mb-30">
                                <div class="trend-top-img">
                                    <img src="{{ asset('storage/' . $featuredPost->image) }}"
                                        alt="{{ $featuredPost->title }}">
                                    <div class="trend-top-cap">
                                        <span class="bgr"
                                            style="background-color:#1ebbf0">{{ $featuredPost->category->name }}</span>
                                        <h2><a
                                                href="{{ route('visitor.post.details', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                                        </h2>
                                        <p>{{ $featuredPost->created_at->format('d M Y') }} | {{ $featuredPost->views }}
                                            Views</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hot Aimated News Tittle-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="trending-tittle">
                                <strong>Trending Now</strong>
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
                            <!-- Latest News -->
                            <div class="section-tittle mb-30">
                                <h3>Latest News</h3>
                            </div>
                            <div class="row">
                                @foreach ($latestPosts as $latestPost)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-what-news mb-30">
                                            <div class="what-img">
                                                <img src="{{ asset('storage/' . $latestPost->image) }}"
                                                    alt="{{ $latestPost->title }}">
                                            </div>
                                            <div class="what-cap">
                                                <span class="color1">{{ $latestPost->category->name }}</span>
                                                <h4><a
                                                        href="{{ route('visitor.post.details', $latestPost->slug) }}">{{ $latestPost->title }}</a>
                                                </h4>
                                                <p>{{ substr(strip_tags($latestPost->description), 0, 100) }}...</p>
                                                <div class="post-meta">
                                                    <span><i class="fa fa-user"></i> {{ $latestPost->writer->name }}</span>
                                                    <span><i class="fa fa-calendar"></i>
                                                        {{ $latestPost->created_at->format('d M Y') }}</span>
                                                    <span><i class="fa fa-eye"></i> {{ $latestPost->views }}</span>
                                                    <span><i class="fa fa-comment"></i> {{ $latestPost->comments }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Section Tittle -->
                            <div class="section-tittle mb-40">
                                <h3>Follow Us</h3>
                            </div>
                            <!-- Flow Socail -->
                            <div class="single-follow mb-45">
                                <div class="single-box">
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="{{ asset('assets/img/news/icon-fb.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Fans</p>
                                        </div>
                                    </div>
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="{{ asset('assets/img/news/icon-tw.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Followers</p>
                                        </div>
                                    </div>
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="{{ asset('assets/img/news/icon-ins.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Followers</p>
                                        </div>
                                    </div>
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="{{ asset('assets/img/news/icon-yo.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Subscribers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Advertisement -->
                            @if ($sidebarAd)
                                <div class="news-poster d-none d-lg-block">
                                    <img src="{{ asset('storage/' . $sidebarAd->image) }}" alt="Advertisement">
                                </div>
                            @endif

                            <!-- Popular Tags -->
                            <div class="section-tittle mb-40 mt-40">
                                <h3>Popular Tags</h3>
                            </div>
                            <div class="tags-area">
                                @foreach ($popularTags as $tag)
                                    <a href="{{ route('tag.posts', $tag->name) }}"
                                        class="tag-link">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->

        <!-- Category News Area -->
        @foreach ($categories as $category)
            @if (count($postsByCategory[$category->id]) > 0)
                <div class="weekly-news-area pt-50 pb-30">
                    <div class="container">
                        <div class="weekly-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-tittle mb-30">
                                        <h3>{{ $category->name }} News</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="weekly-news-active dot-style d-flex">
                                        @foreach ($postsByCategory[$category->id] as $post)
                                            <div class="weekly-single active">
                                                <div class="weekly-img">
                                                    <img src="{{ asset('storage/' . $post->image) }}"
                                                        alt="{{ $post->title }}">
                                                </div>
                                                <div class="weekly-caption">
                                                    <h4><a
                                                            href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a>
                                                    </h4>
                                                    <p>{{ $post->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <!-- End Category News Area -->

  
    </main>
@endsection
