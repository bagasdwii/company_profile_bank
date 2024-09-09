@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <!-- Hero Section -->
    {{-- <section class="hero-section text-white text-center bg-success pb-5">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="assets/home/gambar/1.jpg" class="d-block w-100" alt="Banking Welcome" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h1 class="text-white display-6 display-md-4">Welcome to Bank XYZ</h1>
                        <p class="lead text-white fs-6 fs-md-5">Your trusted financial partner for personal and business banking.</p>
                        <a href="services.html" class="btn btn-light btn-lg">Explore Our Services</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="assets/home/gambar/2.jpg" class="d-block w-100" alt="Banking Growth" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h1 class="text-white display-6 display-md-4">Grow Your Wealth with Us</h1>
                        <p class="lead text-white fs-6 fs-md-5">We offer financial solutions that ensure your steady growth.</p>
                        <a href="services.html" class="btn btn-light btn-lg">See Our Services</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="assets/home/gambar/3.jpg" class="d-block w-100" alt="Banking Support" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h1 class="text-white display-6 display-md-4">24/7 Support</h1>
                        <p class="lead text-white fs-6 fs-md-5">We are always here to assist you, anytime, anywhere.</p>
                        <a href="contact.html" class="btn btn-light btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>

            <!-- Controls for previous/next -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section> --}}
    <section class="hero-section text-white text-center bg-success pb-5">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="assets/home/gambar/1.jpg" class="d-block w-100" alt="Banking Welcome" style="object-fit: cover; height: 400px;">
                    <div class="carousel-caption">
                        <h1 class="text-white display-6 display-md-4">Welcome to Bank XYZ</h1>
                        <p class="lead text-white fs-6 fs-md-5">Your trusted financial partner for personal and business banking.</p>
                        <a href="services.html" class="btn btn-light btn-lg">Explore Our Services</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="assets/home/gambar/2.jpg" class="d-block w-100" alt="Banking Growth" style="object-fit: cover; height: 400px;">
                    <div class="carousel-caption">
                        <h1 class="text-white display-6 display-md-4">Grow Your Wealth with Us</h1>
                        <p class="lead text-white fs-6 fs-md-5">We offer financial solutions that ensure your steady growth.</p>
                        <a href="services.html" class="btn btn-light btn-lg">See Our Services</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="assets/home/gambar/3.jpg" class="d-block w-100" alt="Banking Support" style="object-fit: cover; height: 400px;">
                    <div class="carousel-caption">
                        <h1 class="text-white display-6 display-md-4">24/7 Support</h1>
                        <p class="lead text-white fs-6 fs-md-5">We are always here to assist you, anytime, anywhere.</p>
                        <a href="contact.html" class="btn btn-light btn-lg">Contact Us</a>
                    </div>
                </div>
            </div>

            <!-- Controls for previous/next -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    
    <!-- Additional Content -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Why Choose Us?</h2>
            <p class="lead text-center">At Bank XYZ, we prioritize our clients' needs and provide customized financial solutions that empower their growth. Whether it's personal banking, business solutions, or investment advice, we are here to guide you every step of the way.</p>
            <div class="row text-center mt-5">
                <div class="col-md-4">
                    <img src="assets/home/gambar/1.jpg" alt="Secure" class="img-fluid img-hover-zoom mb-3" width="400">
                    <h4>Secure Banking</h4>
                    <p>Your security is our top priority. We ensure that your financial data is protected at all times.</p>
                </div>
                <div class="col-md-4">
                    <img src="assets/home/gambar/2.jpg" alt="Growth" class="img-fluid img-hover-zoom mb-3" width="400">
                    <h4>Growth Oriented</h4>
                    <p>Our financial products are designed to help you grow your wealth steadily and securely.</p>
                </div>
                <div class="col-md-4">
                    <img src="assets/home/gambar/3.jpg" alt="Support" class="img-fluid img-hover-zoom mb-3" width="400">
                    <h4>24/7 Support</h4>
                    <p>We are always here to assist you with any banking needs you may have, anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection