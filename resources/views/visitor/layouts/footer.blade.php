<footer>
    <div class="footer-area footer-padding fix">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                    <div class="single-footer-caption">
                        <div class="single-footer-caption">
                            <!-- logo -->
                            <div class="footer-logo">
                                <a href="{{ route('visitor.page') }}"><svg width="200" height="60" xmlns="http://www.w3.org/2000/svg">
                                    <text x="10" y="40" font-family="Segoe UI, sans-serif" font-size="44" fill="#1a1a1a">
                                      <tspan fill="#e63946" font-weight="bold">Berita</tspan>kan
                                    </text>
                                  </svg>
                                  
                                  </a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>Beritakan — Portal berita terpercaya yang menyajikan informasi aktual, objektif,
                                        dan mendalam dari berbagai penjuru Indonesia dan dunia.
                                        Tetap terhubung dengan kami untuk update terbaru setiap hari.</p>
                                </div>
                            </div>
                            <!-- social -->
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                    <div class="single-footer-caption mt-60">
                        <div class="footer-tittle">
                            <h4>Newsletter</h4>
                            <p>Heaven fruitful doesn't over les idays appear creeping</p>
                            <!-- Form -->
                            <div class="footer-form">
                                <div>
                                    <form action="{{ route('visitor.newsletter.store') }}" method="POST">
                                        @csrf
                                        <input type="email" name="email" placeholder="Email Address" required>
                                        <div class="form-icon">
                                            <button type="submit"
                                                class="email_icon newsletter-submit button-contactForm">
                                                <img src="{{ asset('frontend') }}/assets/img/logo/form-iocn.png"
                                                    alt="">
                                            </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- footer-bottom aera -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This website is made by <a
                                    href="https://colorlib.com" target="_blank">Verline</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-menu f-right">
                            <ul>
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
