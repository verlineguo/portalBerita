@extends('visitor.layouts.app')
@section('styles')
    <style>
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

        

        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link:active {
            background: linear-gradient(45deg, #1ebbf0, #45b7d1);
            color: #fff;
            border-color: transparent;
            transform: translateY(-2px);
        }


        .color1 {
            background: #1ebbf0;
            color: #fff;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 8px;
            text-transform: uppercase;
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
    </main>
@endsection
