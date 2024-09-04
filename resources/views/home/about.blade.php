@extends('layouts.app')

@section('title', 'About')

@section('content')
<!-- About Us Section -->

<section id="about" class="p-5 bg-light">
    <div class="container">
        <h2 class="text-center font-weight-bold">About Us</h2>
        <p class="text-center">Learn more about our company, our values, and our mission.</p>
        
        <!-- Gallery -->
        <div class="gallery">
            <h3 class="font-weight-bold mb-3">Gallery</h3>
            <div class="row mb-3">
                <div class="col-md-4">
                    <img src="assets/about/gambar/1.jpg" class="img-fluid img-hover-zoom mb-3" alt="Gallery Image 1">
                </div>
                <div class="col-md-4">
                    <img src="assets/about/gambar/2.jpg" class="img-fluid img-hover-zoom mb-3" alt="Gallery Image 2">
                </div>
                <div class="col-md-4">
                    <img src="assets/about/gambar/3.jpg" class="img-fluid img-hover-zoom mb-3" alt="Gallery Image 3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="assets/about/gambar/4.jpg" class="img-fluid img-hover-zoom mb-3" alt="Gallery Image 1">
                </div>
                <div class="col-md-4">
                    <img src="assets/about/gambar/5.jpg" class="img-fluid img-hover-zoom mb-3" alt="Gallery Image 2">
                </div>
                <div class="col-md-4">
                    <img src="assets/about/gambar/6.jpg" class="img-fluid img-hover-zoom mb-3" alt="Gallery Image 3">
                </div>
            </div>
        </div>
        
        <!-- Testimonials -->
        <div class="testimonials mt-5">
            <h3 class="font-weight-bold">Testimonials</h3>
            <blockquote class="blockquote">
                <p class="mb-3">"The service provided by CompanyName is exceptional! Our business has grown significantly thanks to their expertise."</p>
                <footer class="blockquote-footer">John Doe, CEO of SomeCompany</footer>
            </blockquote>
            <blockquote class="blockquote">
                <p class="mb-3">"Professional and reliable. Highly recommended!"</p>
                <footer class="blockquote-footer">Jane Smith, Marketing Director at AnotherCompany</footer>
            </blockquote>
        </div>
        
        <!-- Interactive Section -->
        <div class="interactive mt-5">
            <h3 class="font-weight-bold">Our Mission</h3>
            <video class="w-100" controls>
                <source src="{{ asset('assets/about/video/video.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>
@endsection

