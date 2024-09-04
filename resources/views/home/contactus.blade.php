@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

<!-- Contact Section -->
<section class="contact-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Contact Us</h2>
        <p class="lead text-center">Have any questions? Get in touch with us!</p>
        <div class="row mt-5">
            <div class="col-md-6">
                <h4>Our Office</h4>
                <p>123 Main Street, Anytown, USA</p>
                <p>Email: contact@bankxyz.com</p>
                <p>Phone: (123) 456-7890</p>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Our Location</h5>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345096173!2d144.95565131531827!3d-37.817327979751575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5775b2f34d8e1a5!2s123+Main+St%2C+Cityville%2C+ST+12345!5e0!3m2!1sen!2sau!4v1496729183731" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Send Us a Message</h4>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection