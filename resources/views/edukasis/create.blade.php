@extends('layouts.appv2')
@section('title', 'Data Edukasi')
@section('content')
    <div class="container">
        <a href="/data_edukasi" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('data_edukasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Hidden field untuk user_id -->
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <!-- Form group untuk Judul -->
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul" required>
                    </div>

                    <!-- Form group untuk Keterangan -->
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan" required></textarea>
                    </div>

                    <!-- Form group untuk Tanggal -->
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" required>
                    </div>

                    <!-- Form group untuk Gambar -->
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" class="form-control" name="gambar" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
