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

        /* Recent articles styling */
.single-recents {
    margin: 15px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.single-recents:hover {
    transform: translateY(-5px);
}

.single-recents .what-img img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.single-recents .what-cap {
    padding: 15px;
}

.recent-active .slick-slide {
    margin: 0 10px;
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
            .single-recents .what-img img {
                height: 180px;
            }
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--light-color);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .sidebar-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }
        
        /* Social media links */
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            text-decoration: none;
            color: var(--text-color);
        }
        
        .social-link:hover {
            transform: translateY(-3px);
        }
        
        .social-link img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .newsletter-form {
            display: flex;
            margin-top: 20px;
        }
        
        .newsletter-form input {
            flex-grow: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 5px 0 0 5px;
            outline: none;
        }
        
        .newsletter-form button {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 0 5px 5px 0;
            font-weight: 600;
        }

        .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }
    
    .video-info {
        padding: 15px 0;
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
                            <form class="newsletter-form" action="{{ route('visitor.newsletter.store') }}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Your email address" required>
                                <button type="submit">Subscribe</button>
                            </form>
                            
                            <!-- Advertisement -->
                            <div class="mt-4">
                                @if ($advertisement && $advertisement->status)
                                    <div class="text-center">
                                        <a href="{{ $advertisement->url }}" target="_blank">
                                            <img src="{{ asset('storage/' . $advertisement->image) }}" alt="Advertisement" class="img-fluid rounded">
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('frontend') }}/assets/img/news/news_card.jpg" alt="Advertisement" class="img-fluid rounded">
                                    </div>
                                @endif
                            </div>
                        </div>
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
                            <p>{{ $featuredVideoPost->meta_description ?? 'Stay connected with the latest updates and breaking news from around the world.' }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="video-container">
                                    <iframe height="180" src="https://www.youtube.com/embed/rIz00N40bag" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                                <h6 class="mt-2">{{ $videoPosts[0]->title ?? 'Technology Updates' }}</h6>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="video-container">
                                    <iframe height="180" src="https://www.youtube.com/embed/CONfhrASy44" frameborder="0"
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
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('frontend/assets/img/news/recent' . $loop->iteration . '.jpg') }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="what-cap">
                                    <span class="color1">{{ $post->category->name }}</span>
                                    <h4><a href="{{ route('visitor.post.details', $post->slug) }}">{{ $post->title }}</a></h4>
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
                    @if(isset($paginatedPosts) && $paginatedPosts->hasPages())
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                {{-- Previous Page Link --}}
                                @if ($paginatedPosts->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link"><span class="flaticon-arrow roted"></span></span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $paginatedPosts->previousPageUrl() }}"><span class="flaticon-arrow roted"></span></a></li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($paginatedPosts->getUrlRange(1, $paginatedPosts->lastPage()) as $page => $url)
                                    @if ($page == $paginatedPosts->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($paginatedPosts->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $paginatedPosts->nextPageUrl() }}"><span class="flaticon-arrow right-arrow"></span></a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link"><span class="flaticon-arrow right-arrow"></span></span></li>
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
                responsive: [
                    {
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
                responsive: [
                    {
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
                responsive: [
                    {
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
