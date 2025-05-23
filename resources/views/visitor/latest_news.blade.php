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

        /* Category news styling - FIXED VERSION */
        .weekly-news-active {
            /* Remove the conflicting flexbox styles */
            /* display: flex; */
            /* overflow-x: auto; */
            /* padding-bottom: 20px; */
        }

        /* Slick Slider Overrides */
        .weekly-news-active.slick-initialized {
            display: block !important;
        }

        .weekly-news-active .slick-track {
            display: flex !important;
            width: auto !important;
            min-width: 100% !important;
        }

        .weekly-news-active .slick-slide {
            margin-right: 20px;
            width: auto !important;
            min-width: 270px;
        }

        .weekly-single {
            min-width: 270px;
            /* margin-right: 20px; - handled by slick-slide now */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            overflow: hidden;
            flex-shrink: 0;
        }

        /* Alternative: If you want to disable Slick and use pure CSS */
        .weekly-news-active-fallback {
            display: flex;
            overflow-x: auto;
            padding-bottom: 20px;
            gap: 20px;
            scroll-behavior: smooth;
        }

        .weekly-news-active-fallback::-webkit-scrollbar {
            height: 6px;
        }

        .weekly-news-active-fallback::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .weekly-news-active-fallback::-webkit-scrollbar-thumb {
            background: #1ebbf0;
            border-radius: 3px;
        }

        .weekly-news-active-fallback::-webkit-scrollbar-thumb:hover {
            background: #0ea5d9;
        }

        /* Slick dots styling */
        .weekly-news-active .slick-dots {
            text-align: center;
            margin-top: 20px;
        }

        .weekly-news-active .slick-dots li {
            display: inline-block;
            margin: 0 5px;
        }

        .weekly-news-active .slick-dots li button {
            background: #ddd;
            border: none;
            border-radius: 50%;
            width: 12px;
            height: 12px;
            text-indent: -9999px;
            cursor: pointer;
        }

        .weekly-news-active .slick-dots li.slick-active button {
            background: #1ebbf0;
        }

        /* Responsive fixes */
        @media (max-width: 991px) {
            .weekly-single {
                min-width: 250px;
            }
        }

        @media (max-width: 767px) {
            .weekly-single {
                min-width: 200px;
            }

            .weekly-news-active .slick-slide {
                margin-right: 15px;
            }
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
                                    <img src="{{ asset($featuredPost->image) }}" alt="{{ $featuredPost->title }}">
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
                                                <img src="{{ asset($latestPost->image) }}" alt="{{ $latestPost->title }}">
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
                                            <a href="{{ $advertisement->image }}" target="_blank">
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
                                                    <img src="{{ asset($post->image) }}" width="300px" height="300px"
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Tunggu sampai semua gambar dimuat
            $(window).on('load', function() {
                // Inisialisasi ulang semua slider category
                $('.weekly-news-active').each(function() {
                    var $slider = $(this);

                    // Destroy jika sudah ada
                    if ($slider.hasClass('slick-initialized')) {
                        $slider.slick('unslick');
                    }

                    // Inisialisasi dengan delay
                    setTimeout(function() {
                        $slider.slick({
                            dots: true,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            responsive: [{
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 3,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: 768,
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
                    }, 100);
                });
            });
        });
    </script>
@endsection