<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Website Landing Page With Full Screen Draggable Image Slider - Html, Css & Javascript</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    {{-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="nav-bar">
            <a href="" class="logo">Logo</a>
            <div class="navigation">
                <div class="nav-items">
                    <!-- Close Button -->
                    <i class="fas fa-times nav-close-btn"></i>

                    <!-- Authentication Links -->
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="auth-link">Dashboard</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="auth-link">Log in/Register</a>
                            @endif
                        @endauth
                    @endif

                    <!-- Navigation Links -->
                    <a href="#home">
                        <i class="fas fa-home"></i> Home
                    </a>

                    <a href="#about">
                        <i class="fas fa-info-circle"></i> About
                    </a>

                    <a href="#contact">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </div>
            </div>
            <i class="fas fa-bars nav-menu-btn"></i>
        </div>
    </header>

    <section class="home" id="home">
        <div class="media-icons">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
    
       <!-- Swiper Slider -->
        <div class="swiper bg-slider">
            <div class="swiper-wrapper">
                <!-- Slide 1: Autumn -->
                <div class="swiper-slide">
                    <video autoplay muted loop class="video-background">
                        <source src="{{ asset('videos/dollar_and_coins.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="text-content">
                        <h2 class="title">Autumn <span>Season</span></h2>
                        <p>
                            Autumn, also known as fall in North American English, is one of the four temperate seasons.
                            Outside the tropics, autumn marks the transition from summer to winter, in September or March.
                            Autumn is the season when the duration of daylight becomes noticeably shorter and the temperature
                            cools considerably.
                        </p>
                        <button class="read-btn">
                            Read More <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Slide 2: Winter -->
                <div class="swiper-slide dark-layer">
                    <video autoplay muted loop class="video-background">
                        <source src="{{ asset('videos/calculator_debt_crdt.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="text-content">
                        <h2 class="title">Winter <span>Season</span></h2>
                        <p>
                            Winter is the coldest season of the year in polar and temperate zones. It occurs between autumn
                            and spring. The tilt of Earth's axis causes seasons; winter occurs when a hemisphere is oriented
                            away from the Sun. Different cultures define different dates as the start of winter, and some use
                            a definition based on weather.
                        </p>
                        <button class="read-btn">
                            Read More <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Slide 3: Summer -->
                <div class="swiper-slide dark-layer">
                    <video autoplay muted loop class="video-background">
                        <source src="{{ asset('videos/deal_done.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="text-content">
                        <h2 class="title">Summer <span>Season</span></h2>
                        <p>
                            Summer is the hottest of the four temperate seasons, occurring after spring and before autumn. At
                            or around the summer solstice, the earliest sunrise and latest sunset occurs, daylight hours are
                            longest and dark hours are shortest, with day length decreasing as the season progresses after the
                            solstice.
                        </p>
                        <button class="read-btn">
                            Read More <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Slide 4: Spring -->
                <div class="swiper-slide">
                    <video autoplay muted loop class="video-background">
                        <source src="{{ asset('videos/graphs.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="text-content">
                        <h2 class="title">Spring <span>Season</span></h2>
                        <p>
                            Spring, also known as springtime, is one of the four temperate seasons, succeeding winter and
                            preceding summer. There are various technical definitions of spring, but local usage of the term
                            varies according to local climate, cultures and customs. When it is spring in the Northern
                            Hemisphere, it is autumn in the Southern Hemisphere and vice versa.
                        </p>
                        <button class="read-btn">
                            Read More <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Add Pagination (Optional) -->
            <div class="swiper-pagination"></div>

            <!-- Add Navigation (Optional) -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Thumbnails for Slider -->
        <div class="bg-slider-thumbs">
            <div class="swiper-wrapper thumbs-container">
                <img src="{{asset('images/dollar_and_coins.jpg')}}" class="swiper-slide" alt="">
                <img src="{{ asset('images/calculator_debt_crdt.jpg') }}" class="swiper-slide" alt="">
                <img src="{{asset('images/deal_done.jpg')}}" class="swiper-slide" alt="">
                <img src="{{asset('images/graphs.jpg')}}" class="swiper-slide" alt="">
            </div>
        </div>
    </section>

    <section class="about section" id="about">
        <div class="about-container">
            <h2 class="about-title">About Our Accounting Software</h2>
            <div class="about-content">
                <p class="about-text">
                    Our accounting software is designed to simplify financial management for businesses of all sizes. With powerful tools and intuitive features, you can streamline your accounting processes, track expenses, generate reports, and stay compliant with tax regulations.
                </p>
                <p class="about-text">
                    Whether you're a small business owner or a large enterprise, our software provides the flexibility and scalability you need to manage your finances effectively. From invoicing and payroll to budgeting and forecasting, we've got you covered.
                </p>
                <p class="about-text">
                    Our mission is to empower businesses with the tools they need to make informed financial decisions. With real-time data and advanced analytics, you can gain valuable insights into your business performance and drive growth.
                </p>
                <p class="about-text">
                    Join thousands of satisfied customers who trust our accounting software to manage their finances with ease. Experience the difference today and take control of your financial future.
                </p>
            </div>
            <div class="about-features">
                <div class="feature">
                    <i class="fas fa-chart-line"></i>
                    <h3 class="feature-title">Advanced Analytics</h3>
                    <p class="feature-description">Gain insights into your business performance with real-time data and advanced analytics.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h3 class="feature-title">Easy Invoicing</h3>
                    <p class="feature-description">Create and send professional invoices in minutes, and track payments effortlessly.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h3 class="feature-title">Expense Tracking</h3>
                    <p class="feature-description">Track expenses, categorize transactions, and stay on top of your budget.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-shield-alt"></i>
                    <h3 class="feature-title">Secure & Reliable</h3>
                    <p class="feature-description">Your data is safe with our secure, cloud-based platform and regular backups.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact section py-5 custom-bg" id="contact">
        @include('contact')
    </section>
    
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>
