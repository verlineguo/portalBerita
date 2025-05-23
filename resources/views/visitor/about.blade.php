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
    </style>
@endsection
@section('content')
    <main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                <!-- Hot Aimated News Tittle-->
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
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90">
                            <div class="about-img">
                                <img src="assets/img/post/about_heor.jpg" alt="">
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3>About Us</h3>
                            </div>
                            <div class="about-prea">

                                <p class="about-pera1 mb-25 text-justify">
                                    Beritakan adalah portal berita digital yang hadir untuk menyajikan informasi terkini,
                                    terpercaya, dan relevan bagi masyarakat Indonesia. Kami berkomitmen untuk menjadi sumber
                                    berita yang objektif, mendalam, dan mudah diakses kapan saja dan di mana saja.

                                    Dengan semangat jurnalistik yang independen, Beritakan memuat beragam topik mulai dari
                                    peristiwa nasional, internasional, ekonomi, teknologi, hingga gaya hidup dan hiburan.
                                    Setiap artikel yang kami tayangkan melalui proses verifikasi dan kurasi agar pembaca
                                    mendapatkan informasi yang akurat dan bernilai.

                                    Kami percaya bahwa informasi yang benar adalah pondasi dari masyarakat yang cerdas. Oleh
                                    karena itu, kami terus berinovasi dalam penyajian berita agar tetap relevan dengan
                                    perkembangan zaman dan kebutuhan pembaca.

                                    Beritakan. Cerita dari Indonesia, untuk Indonesia.</p>
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




                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About US End -->
    </main>
@endsection
