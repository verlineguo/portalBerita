<header>
       <div class="header-area">
            <div class="main-header">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>     
                                        <li><img src="{{ asset('frontend') }}/assets/img/icon/header_icon1.png" alt="">34ºc, Sunny </li>
                                        <li><img src="{{ asset('frontend/assets/img/icon/header_icon1.png') }}" alt="">
                                            <span id="current-date"></span>
                                        </li>                     
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                       <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="{{ route('visitor.page') }}"><svg width="200" height="60" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="200" height="60" fill="#ffffff"/>
                                        <text x="10" y="40" font-family="Segoe UI, sans-serif" font-size="40" fill="#1a1a1a">
                                          <tspan fill="#e63946" font-weight="bold">Berita</tspan>kan
                                        </text>
                                      </svg>
                                      </a>
                                </div>
                            </div>
                          
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>                  
                                        <ul id="navigation">    
                                            <li><a href="{{ route('visitor.page') }}">Home</a></li>
                                            <li><a href="{{ route('visitor.category') }}">Category</a></li>
                                            <li><a href="{{ route('visitor.about') }}">About</a></li>
                                            <li><a href="{{ route('visitor.latest_news') }}">Latest News</a></li>
                                            <li><a href="{{ route('visitor.contact') }}">Contact</a></li>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="#">
                                            <input type="text" placeholder="Search">
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
    </header>

    <script>
        function updateDate() {
            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('current-date').textContent = new Date().toLocaleDateString('id-ID', options);
        }
        updateDate();
    </script>
    