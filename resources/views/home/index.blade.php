@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <!-- Hero Section -->
    <section class="hero-section text-white text-center bg-primary py-5">
        <div class="container">
            <h1>Welcome to Bank XYZ</h1>
            <p class="lead">Your trusted financial partner for personal and business banking.</p>
            <a href="services.html" class="btn btn-light btn-lg">Explore Our Services</a>
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