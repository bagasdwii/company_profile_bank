@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<!-- Profile Section -->
<section id="profile" class="p-5 bg-light">
    <div class="container">
        <!-- Header Gambar -->
        <div class="text-center mb-5">
            <img src="https://via.placeholder.com/1200x400" class="img-fluid" alt="Profile Header Image">
            <h1 class="mt-4">Profile</h1>
        </div>

        <!-- Selamat datang -->
        <div class="text-center mb-4">
            <h2>Selamat datang di Bank XYZ</h2>
            <p class="lead">Kami hadir untuk melayani Anda dengan sepenuh hati. Nikmati layanan terbaik kami dan jadikan pengalaman perbankan Anda lebih mudah dan nyaman.</p>
        </div>

        <!-- Bagian Tombol dan Konten -->
        <div class="row">
            <!-- Tombol di sisi kiri -->
            <div class="col-md-4">
                <div class="list-group" id="button-list">
                    <a href="#" class="list-group-item list-group-item-action active" id="button1">Tombol 1</a>
                    <a href="#" class="list-group-item list-group-item-action" id="button2">Tombol 2</a>
                    <a href="#" class="list-group-item list-group-item-action" id="button3">Tombol 3</a>
                    <a href="#" class="list-group-item list-group-item-action" id="button4">Tombol 4</a>
                </div>
            </div>

            <!-- Konten di sisi kanan -->
            <div class="col-md-8">
                <div id="content1" class="content-box">
                    <h3>Konten Tombol 1</h3>
                    <img src="https://via.placeholder.com/600x300" class="img-fluid mb-3" alt="Gambar Tombol 1">
                    <p>Ini adalah konten dari Tombol 1. Jelajahi informasi ini lebih lanjut untuk mendapatkan lebih banyak detail mengenai fitur kami.</p>
                </div>

                <div id="content2" class="content-box d-none">
                    <h3>Konten Tombol 2</h3>
                    <img src="https://via.placeholder.com/600x300" class="img-fluid mb-3" alt="Gambar Tombol 2">
                    <p>Ini adalah konten dari Tombol 2. Kami memberikan layanan yang cepat dan andal.</p>
                </div>

                <div id="content3" class="content-box d-none">
                    <h3>Konten Tombol 3</h3>
                    <img src="https://via.placeholder.com/600x300" class="img-fluid mb-3" alt="Gambar Tombol 3">
                    <p>Ini adalah konten dari Tombol 3. Kami menjaga kepercayaan Anda dengan solusi keuangan terbaik.</p>
                </div>

                <div id="content4" class="content-box d-none">
                    <h3>Konten Tombol 4</h3>
                    <img src="https://via.placeholder.com/600x300" class="img-fluid mb-3" alt="Gambar Tombol 4">
                    <p>Ini adalah konten dari Tombol 4. Pelayanan kami akan membuat perbankan Anda lebih mudah dan aman.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script untuk mengganti konten saat tombol diklik -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('#button-list .list-group-item');
        const contents = document.querySelectorAll('.content-box');

        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Set semua tombol menjadi tidak aktif
                buttons.forEach(btn => btn.classList.remove('active'));

                // Aktifkan tombol yang diklik
                button.classList.add('active');

                // Sembunyikan semua konten
                contents.forEach(content => content.classList.add('d-none'));

                // Tampilkan konten yang sesuai dengan tombol yang diklik
                const contentId = button.id.replace('button', 'content');
                document.getElementById(contentId).classList.remove('d-none');
            });
        });
    });
</script>
@endsection
