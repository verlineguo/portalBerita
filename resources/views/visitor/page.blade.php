@extends('visitor.layouts.app')
@section('Visitor_page_title')
    News Portal - Home
@endsection
@section('styles')
    <style>
        /* Custom CSS for Home Page - Improved Layout */

        /* Global styling */
        * {
            box-sizing: border-box;
        }



        /* Post meta styling */
        .post-meta {
            margin-top: 15px;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .post-meta span {
            margin-right: 15px;
            display: inline-block;
        }

        .post-meta i {
            margin-right: 5px;
            color: #1ebbf0;
        }



        /* Featured post styling */
        .trend-bottom-img {
            overflow: hidden;
            height: 200px;
            border-radius: 5px;
        }

        .trend-bottom-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .single-bottom:hover .trend-bottom-img img {
            transform: scale(1.05);
        }

        .trend-bottom-cap h4 a {
            color: #000;
            transition: color 0.3s ease;
        }

        .trend-bottom-cap h4 a:hover {
            color: #1ebbf0;
            text-decoration: none;
        }

        /* Right side posts */
        .trand-right-single {
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .trand-right-single:hover {
            transform: translateX(5px);
        }

        .trand-right-img {
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 6px;
            width: 120px;
            height: 90px;
            margin-right: 15px;
        }

        .trand-right-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }




        .trand-right-cap h4 a {
            color: #000;
            transition: color 0.3s ease;
        }

        .trand-right-cap h4 a:hover {
            color: #1ebbf0;
            text-decoration: none;
        }


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

     


.what-img {
    overflow: hidden;
    height: 220px;
    position: relative;
    width: 100%;
}

.what-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.single-what-news:hover .what-img img {
    transform: scale(1.05);
}





        /* Weekly news styling - Consistent sizing */
        .weekly-single {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin: 0 10px;
            width: 300px !important;
            flex-shrink: 0;
        }

        .weekly-single:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .weekly-img {
            overflow: hidden;
            height: 200px;
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
            padding: 20px;
        }

        .weekly-caption h4 {
            font-size: 16px;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0;
        }

        .weekly-caption h4 a {
            color: #000;
            transition: color 0.3s ease;
        }

        .weekly-caption h4 a:hover {
            color: #1ebbf0;
            text-decoration: none;
        }

        /* Recent articles styling */
        .single-recents {
            margin: 15px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .single-recents:hover {
            transform: translateY(-5px);
        }

        .single-recents .what-img {
            height: 200px;
        }

        .single-recents .what-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .single-recents:hover .what-img img {
            transform: scale(1.1);
        }

        .single-recents .what-cap {
            padding: 15px;
        }

        .single-recents .what-cap h4 a {
            color: #000;
            transition: color 0.3s ease;
        }

        .single-recents .what-cap h4 a:hover {
            color: #1ebbf0;
            text-decoration: none;
        }

        .recent-active .slick-slide {
            margin: 0 10px;
        }

        /* Sidebar improvements */
        .sidebar {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .sidebar-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1ebbf0;
            color: #000;
        }

        /* Social media links */
        .social-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            color: #1ebbf0;
        }

        .social-link img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .newsletter-form {
            display: flex;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .newsletter-form input {
            flex-grow: 1;
            padding: 12px 15px;
            border: none;
            outline: none;
            font-size: 14px;
        }

        .newsletter-form button {
            background: linear-gradient(45deg, #1ebbf0, #45b7d1);
            color: white;
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-form button:hover {
            background: linear-gradient(45deg, #45b7d1, #1ebbf0);
        }

        /* Video section styling */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .video-info h4 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #000;
        }

        .video-info p {
            color: #666;
            line-height: 1.6;
        }

        /* Section titles */
        .section-tittle h3 {
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-tittle h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #1ebbf0, #45b7d1);
            border-radius: 2px;
        }



        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link:active {
            background: linear-gradient(45deg, #1ebbf0, #45b7d1);
            color: #fff;
            border-color: transparent;
            transform: translateY(-2px);
        }


        #js-news {
            animation: ticker 20s infinite linear;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .news-item {
            height: 30px;
            padding: 5px 0;
            line-height: 20px;
            color: white;
        }

        @keyframes ticker {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        /* Slick slider customization */
        .slick-dots {
            text-align: center;
            margin-top: 30px;
        }

        .slick-dots li {
            display: inline-block;
            margin: 0 8px;
        }

        .slick-dots li button {
            background: #ddd;
            border: none;
            border-radius: 50%;
            width: 12px;
            height: 12px;
            text-indent: -9999px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slick-dots li.slick-active button,
        .slick-dots li button:hover {
            background: #1ebbf0;
            transform: scale(1.2);
        }

        /* Responsive adjustments */
        @media (max-width: 1199px) {
            .weekly-single {
                width: 280px !important;
            }

            .single-recents {
                width: 260px !important;
            }
        }



        @media (max-width: 991px) {
            .trend-top-cap {
                padding: 25px;
            }

            .trend-top-cap h2 a {
                font-size: 24px;
            }

            .weekly-single {
                width: 250px !important;
            }

            .single-recents {
                width: 240px !important;
            }

            .social-links {
                grid-template-columns: 1fr;
            }

            .trand-right-img {
                width: 100px;
                height: 75px;
            }

            .weekly-single,
            .weekly2-single {
                min-width: 250px;
            }

            .what-cap {
                padding: 20px;
            }

            .what-cap h4 {
                font-size: 16px;
            }

            .what-img {
                height: 200px;
            }

        }

        @media (max-width: 767px) {
            .trend-top-cap h2 a {
                font-size: 24px;
            }

            .weekly-single,
            .weekly2-single {
                min-width: 200px;
            }

            .weekly-news-active .slick-slide,
            .weekly2-news-active .slick-slide {
                margin-right: 15px;
            }

            .trend-top-img img {
                height: 300px;
            }

            .trend-bottom-img img,
            .weekly-img img,
            .what-img img,
            .weekly2-img img,
            .single-recents .what-img img {
                height: 180px;
            }

            .what-img {
                height: 180px;
            }

            .what-cap {
                padding: 15px;
            }

            .what-cap h4 {
                font-size: 15px;
                margin-bottom: 10px;
            }

        }

        /* Equal height for cards */
        .equal-height {
            display: flex;
            flex-wrap: wrap;
        }

        .equal-height>[class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .equal-height .single-what-news,
        .equal-height .single-bottom {
            flex: 1;
        }

        /* Loading animation */
        .loading {
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix">
            <div class="container">
                <div class="trending-main">
                    <!-- Trending Tittle -->
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
                            <!-- Trending Top -->
                            <div class="trending-top mb-30">
                                <div class="trend-top-img">
                                    <img src="{{ $featuredPost->image ? asset($featuredPost->image) : asset('frontend/assets/img/trending/trending_top.jpg') }}"
                                        alt="{{ $featuredPost->title }}">
                                    <div class="trend-top-cap">
                                        <span>{{ $featuredPost->category->name ?? 'Trending' }}</span>
                                        <h2><a
                                                href="{{ route('visitor.post.details', $featuredPost->slug ?? '') }}">{{ $featuredPost->title ?? 'Welcome To The Best News Portal' }}</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <!-- Trending Bottom -->
                            <div class="trending-bottom">
                                <div class="row">
                                    @foreach ($popularPosts as $post)
                                        <div class="col-lg-4">
                                            <div class="single-bottom mb-35">
                                                <div class="trend-bottom-img mb-30">
                                                    <img src="{{ $post->image ? asset($post->image) : asset('frontend/assets/img/trending/trend_bottom.jpg') }}"
                                                        alt="{{ $post->title }}">
                                                </div>
                                                <div class="trend-bottom-cap">
                                                    <span
                                                        class="color{{ $loop->iteration }}">{{ $post->category->name }}</span>
                                                    <h4><a
                                                            href="{{ route('visitor.post.details', parameters: $post->slug) }}">{{ $post->title }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Right content -->
                        <div class="col-lg-4">
                            @foreach ($rightSidePosts as $post)
                                <div class="trand-right-single d-flex">
                                    <div class="trand-right-img">
                                        <img src="{{ $post->image ? asset($post->image) : asset('frontend/assets/img/trending/right' . $loop->iteration . '.jpg') }}"
                                            alt="{{ $post->title }}">
                                    </div> <!-- Add this closing div -->
                                    <div class="trand-right-cap">
                                        <span class="color{{ $loop->iteration }}">{{ $post->category->name }}</span>
                                        <h4><a
                                                href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->



        <!-- Whats New Start -->
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                <div class="section-tittle mb-30">
                                    <h3>Latest News</h3>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="properties__button">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                                href="#nav-home" role="tab" aria-controls="nav-home"
                                                aria-selected="true">All</a>
                                            @foreach ($categories as $category)
                                                <a class="nav-item nav-link" id="nav-{{ $category->slug }}-tab"
                                                    data-toggle="tab" href="#nav-{{ $category->slug }}" role="tab"
                                                    aria-controls="nav-{{ $category->slug }}"
                                                    aria-selected="false">{{ $category->name }}</a>
                                            @endforeach
                                        </div>
                                    </nav>
                                    <!--End Nav Button  -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- card one (All) -->
                                    <!-- Latest News Section - Fixed -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach ($latestPosts as $post)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="{{ $post->image ? asset($post->image) : asset('frontend/assets/img/news/whatNews' . $loop->iteration . '.jpg') }}"
                                                            alt="{{ $post->title }}">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">{{ $post->category->name }}</span>
                                                        <h4><a
                                                                href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Category tabs -->
                            @foreach ($categories as $category)
                                <div class="tab-pane fade" id="nav-{{ $category->slug }}" role="tabpanel"
                                    aria-labelledby="nav-{{ $category->slug }}-tab">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @foreach ($categoryPosts[$category->id] as $post)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                            <img src="{{ $post->image ? asset($post->image) : asset('frontend/assets/img/news/whatNews' . $loop->iteration . '.jpg') }}"
                                                                alt="{{ $post->title }}">

                                                        </div>
                                                        <div class="what-cap">
                                                            <span class="color1">{{ $category->name }}</span>
                                                            <h4><a
                                                                    href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <h4 class="sidebar-title">Subscribe & Follow</h4>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <img src="{{ asset('frontend') }}/assets/img/news/icon-fb.png" alt="Facebook">
                                    <span>Facebook</span>
                                </a>
                                <a href="#" class="social-link">
                                    <img src="{{ asset('frontend') }}/assets/img/news/icon-tw.png" alt="Twitter">
                                    <span>Twitter</span>
                                </a>
                                <a href="#" class="social-link">
                                    <img src="{{ asset('frontend') }}/assets/img/news/icon-ins.png" alt="Instagram">
                                    <span>Instagram</span>
                                </a>
                                <a href="#" class="social-link">
                                    <img src="{{ asset('frontend') }}/assets/img/news/icon-yo.png" alt="YouTube">
                                    <span>YouTube</span>
                                </a>
                            </div>

                            <h4 class="sidebar-title mt-4">Newsletter</h4>
                            <p>Stay updated with our latest news and updates directly in your inbox.</p>
                            <form class="newsletter-form" action="{{ route('visitor.newsletter.store') }}"
                                method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Your email address" required>
                                <button type="submit">Subscribe</button>
                            </form>

                            <!-- Advertisement -->
                            <div class="mt-4">
                                @if ($advertisement && $advertisement->status)
                                    <div class="text-center">
                                        <a href="{{ $advertisement->url }}" target="_blank">
                                            <img src="{{ asset($advertisement->image) }}" alt="Advertisement"
                                                class="img-fluid rounded">
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('frontend') }}/assets/img/news/news_card.jpg"
                                            alt="Advertisement" class="img-fluid rounded">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Whats New End -->

        <!--   Weekly-News start -->
        <div class="weekly-news-area pt-50">
            <div class="container">
                <div class="weekly-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Weekly Top News</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="weekly-news-active dot-style d-flex dot-style">
                                @foreach ($weeklyTopNews as $post)
                                    <div class="weekly-single {{ $loop->first ? 'active' : '' }}">
                                        <div class="weekly-img">
                                            <img src="{{ $post->image ? asset($post->image) : asset('frontend/assets/img/news/weeklyNews' . $loop->iteration . '.jpg') }}"
                                                alt="{{ $post->title }}">
                                        </div>
                                        <div class="weekly-caption">
                                            <span class="color1">{{ $post->category->name }}</span>
                                            <h4><a
                                                    href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a>
                                            </h4>
                                            <div class="post-meta">
                                                <span><i class="fa fa-user"></i>
                                                    {{ $post->writer->name ?? 'Admin' }}</span>
                                                <span><i class="fa fa-calendar"></i>
                                                    {{ $post->created_at->format('d M Y') }}</span>
                                                <span><i class="fa fa-eye"></i> {{ $post->views ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Weekly-News -->

        <!-- Start Youtube -->
        <!-- Video Gallery Section -->
        <section class="bg-light py-5 mb-5">
            <div class="container">
                <h3 class="section-heading">Video Gallery</h3>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="video-container mb-4">
                            <iframe height="400" src="https://www.youtube.com/embed/CicQIuG8hBo" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="video-info">
                            <h4>{{ $featuredVideoPost->title ?? 'Latest Breaking News Updates' }}</h4>
                            <p>{{ $featuredVideoPost->meta_description ?? 'Stay connected with the latest updates and breaking news from around the world.' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="video-container">
                                    <iframe height="180" src="https://www.youtube.com/embed/rIz00N40bag"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                                <h6 class="mt-2">{{ $videoPosts[0]->title ?? 'Technology Updates' }}</h6>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="video-container">
                                    <iframe height="180" src="https://www.youtube.com/embed/CONfhrASy44"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                                <h6 class="mt-2">{{ $videoPosts[1]->title ?? 'Sports Highlights' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Replace the Recent Articles section with this improved version -->
        <div class="recent-articles">
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Recent Articles</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">
                                @foreach ($recentArticles as $post)
                                    <div class="single-recents">
                                        <div class="what-img">
                                            <img src="{{ $post->image ? asset($post->image) : asset('frontend/assets/img/news/recent' . $loop->iteration . '.jpg') }}"
                                                alt="{{ $post->title }}">
                                        </div>
                                        <div class="what-cap">
                                            <span class="color1">{{ $post->category->name }}</span>
                                            <h4><a
                                                    href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start pagination -->
        <div class="pagination-area pb-45 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            @if (isset($paginatedPosts) && $paginatedPosts->hasPages())
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                        {{-- Previous Page Link --}}
                                        @if ($paginatedPosts->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link"><span
                                                        class="flaticon-arrow roted"></span></span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $paginatedPosts->previousPageUrl() }}"><span
                                                        class="flaticon-arrow roted"></span></a></li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($paginatedPosts->getUrlRange(1, $paginatedPosts->lastPage()) as $page => $url)
                                            @if ($page == $paginatedPosts->currentPage())
                                                <li class="page-item active"><span
                                                        class="page-link">{{ $page }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($paginatedPosts->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $paginatedPosts->nextPageUrl() }}"><span
                                                        class="flaticon-arrow right-arrow"></span></a></li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link"><span
                                                        class="flaticon-arrow right-arrow"></span></span></li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End pagination  -->

    </main>

    <script>
        $(document).ready(function() {
            // Initialize trending news ticker
            $('#js-news').ticker({
                speed: 0.10,
                ajaxFeed: false,
                feedType: 'json',
                htmlFeed: true,
                debugMode: false,
                controls: true,
                titleText: ''
            });

            // Initialize Weekly News slider
            $('.weekly-news-active').slick({
                dots: true,
                infinite: true,
                speed: 500,
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Initialize Weekly2 News slider
            $('.weekly2-news-active').slick({
                dots: true,
                infinite: true,
                speed: 500,
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Initialize Recent Articles slider
            $('.recent-active').slick({
                dots: true,
                infinite: true,
                speed: 500,
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection
