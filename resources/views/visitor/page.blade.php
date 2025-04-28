@extends('visitor.layouts.app')
@section('Visitor_page_title')
    News Portal - Home
@endsection
@section('styles')
    <style>
        /* Global image control */
        .img-container {
            overflow: hidden;
            position: relative;
        }

        /* Trending section images */
        .trend-top-img img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .trend-bottom-img img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .trand-right-img img {
            width: 100px;
            height: 80px;
            object-fit: cover;
        }

        /* Weekly news images */
        .weekly-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        /* What's New section */
        .what-img img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* Weekly2 section */
        .weekly2-img img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        /* Recent articles */
        .single-recent .what-img img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .trend-top-img img {
                height: 300px;
            }

            .trend-bottom-img img,
            .weekly-img img,
            .what-img img,
            .weekly2-img img,
            .single-recent .what-img img {
                height: 180px;
            }
        }
    </style>
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
                                    <img src="{{ $featuredPost->image ? asset('storage/' . $featuredPost->image) : asset('frontend/assets/img/trending/trending_top.jpg') }}"
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
                                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/trending/trend_bottom.jpg') }}"
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
                                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/trending/right' . $loop->iteration . '.jpg') }}"
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
                                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/news/weeklyNews' . $loop->iteration . '.jpg') }}"
                                                alt="{{ $post->title }}">
                                        </div>
                                        <div class="weekly-caption">
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
        <!-- End Weekly-News -->

        <!-- Whats New Start -->
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                <div class="section-tittle mb-30">
                                    <h3>Whats New</h3>
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
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                @foreach ($latestPosts as $post)
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="single-what-news mb-100">
                                                            <div class="what-img">
                                                                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/news/whatNews' . $loop->iteration . '.jpg') }}"
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
                                                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/news/whatNews' . $loop->iteration . '.jpg') }}"
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
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>Follow Us</h3>
                        </div>
                        <!-- Flow Socail -->
                        <div class="single-follow mb-45">
                            <div class="single-box">
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('frontend') }}/assets/img/news/icon-fb.png"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('frontend') }}/assets/img/news/icon-tw.png"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('frontend') }}/assets/img/news/icon-ins.png"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('frontend') }}/assets/img/news/icon-yo.png"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Advertisement -->
                        @if ($advertisement && $advertisement->status)
                            <div class="news-poster d-none d-lg-block">
                                <img src="{{ asset('storage/' . $advertisement->image) }}"
                                    alt="Advertisement">
                            </div>
                        @else
                            <div class="news-poster d-none d-lg-block">
                                <img src="{{ asset('frontend') }}/assets/img/news/news_card.jpg" alt="Advertisement">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Whats New End -->

        <!--   Weekly2-News start -->
        <div class="weekly2-news-area weekly2-pading gray-bg">
            <div class="container">
                <div class="weekly2-wrapper">
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
                            <div class="weekly2-news-active dot-style d-flex dot-style">
                                @foreach ($weekly2Posts as $post)
                                    <div class="weekly2-single">
                                        <div class="weekly2-img">
                                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/news/weekly2News' . $loop->iteration . '.jpg') }}"
                                                alt="{{ $post->title }}">

                                        </div>
                                        <div class="weekly2-caption">
                                            <span class="color1">{{ $post->category->name }}</span>
                                            <p>{{ $post->created_at->format('d M Y') }}</p>
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
        <!-- End Weekly-News -->

        <!-- Start Youtube -->
        <div class="youtube-area video-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="video-items-active">
                            <div class="video-items text-center">
                                <iframe src="https://www.youtube.com/embed/CicQIuG8hBo" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="video-items text-center">
                                <iframe src="https://www.youtube.com/embed/rIz00N40bag" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="video-items text-center">
                                <iframe src="https://www.youtube.com/embed/CONfhrASy44" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="video-items text-center">
                                <iframe src="https://www.youtube.com/embed/lq6fL2ROWf8" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="video-items text-center">
                                <iframe src="https://www.youtube.com/embed/0VxlQlacWV4" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-info">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="video-caption">
                                <div class="top-caption">
                                    <span class="color1">{{ $featuredVideoPost->category->name ?? 'Featured' }}</span>
                                </div>
                                <div class="bottom-caption">
                                    <h2>{{ $featuredVideoPost->title ?? 'Welcome To The Best News Portal' }}</h2>
                                    <p>{{ $featuredVideoPost->meta_description ?? 'Latest news and updates from around the world.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="testmonial-nav text-center">
                                <div class="single-video">
                                    <iframe src="https://www.youtube.com/embed/CicQIuG8hBo" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video-intro">
                                        <h4>{{ $videoPosts[0]->title ?? 'Latest Video News' }}</h4>
                                    </div>
                                </div>
                                <div class="single-video">
                                    <iframe src="https://www.youtube.com/embed/rIz00N40bag" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video-intro">
                                        <h4>{{ $videoPosts[1]->title ?? 'Latest Video News' }}</h4>
                                    </div>
                                </div>
                                <div class="single-video">
                                    <iframe src="https://www.youtube.com/embed/CONfhrASy44" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video-intro">
                                        <h4>{{ $videoPosts[2]->title ?? 'Latest Video News' }}</h4>
                                    </div>
                                </div>
                                <div class="single-video">
                                    <iframe src="https://www.youtube.com/embed/lq6fL2ROWf8" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video-intro">
                                        <h4>{{ $videoPosts[3]->title ?? 'Latest Video News' }}</h4>
                                    </div>
                                </div>
                                <div class="single-video">
                                    <iframe src="https://www.youtube.com/embed/0VxlQlacWV4" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video-intro">
                                        <h4>{{ $videoPosts[4]->title ?? 'Latest Video News' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Start youtube -->

        <!--  Recent Articles start -->
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
                                    <div class="single-recent mb-100">
                                        <div class="what-img">
                                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/news/recent' . $loop->iteration . '.jpg') }}"
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
        <!-- Recent Articles End -->

        <!-- Start pagination -->
        <div class="pagination-area pb-45 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item"><a class="page-link" href="#"><span
                                                class="flaticon-arrow roted"></span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><span
                                                class="flaticon-arrow right-arrow"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End pagination  -->

    </main>
@endsection
