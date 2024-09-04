@extends('layouts.app')

@section('title', 'Our Team')

@section('content')

<!-- Our Team Section -->
<section id="team" class="p-5">
    <div class="container">
        <h2 class="text-center font-weight-bold">Our Team</h2>
        <div class="row">
            <div class="col-md-3 text-center">
                <div class="team-member">
                    <img src="assets/team/gambar/1.jpg" alt="Team Member 1" class="team-img rounded-circle mb-3"width="50%">
                    <h4>John Doe</h4>
                    <p>CEO</p>
                    <p>John is the visionary behind CompanyName, leading the team with passion and dedication.</p>
                </div>
                
            </div>
            <div class="col-md-3 text-center">
                <div class="team-member">
                    <img src="assets/team/gambar/2.jpg" alt="Team Member 2" class="team-img rounded-circle mb-3" width="50%">
                    <h4>Jane Smith</h4>
                    <p>CTO</p>
                    <p>Jane is responsible for the technological direction of the company, ensuring we stay ahead of the curve.</p>
                </div>
               
            </div>
            <div class="col-md-3 text-center">
                <div class="team-member">
                    <img src="assets/team/gambar/3.jpg" alt="Team Member 3" class="team-img rounded-circle mb-3"width="50%">
                    <h4>Mike Johnson</h4>
                    <p>CFO</p>
                    <p>Mike oversees financial operations, making sure our company remains financially strong.</p>
                </div>
                
            </div>
            <div class="col-md-3 text-center">
                <div class="team-member">
                    <img src="assets/team/gambar/4.jpg" alt="Team Member 1" class="team-img rounded-circle mb-3">
                    <h4>John Doe</h4>
                    <p>CEO</p>
                    <p>John is the visionary behind CompanyName, leading the team with passion and dedication.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
