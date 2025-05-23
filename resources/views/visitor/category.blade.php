@extends('visitor.layouts.app')
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
                        <img src="{{ asset($advertisement->image) }}"
                            alt="Advertisement">
                    </div>
               
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Whats New End -->
    </main>
@endsection