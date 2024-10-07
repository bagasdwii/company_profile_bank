@extends('layouts.appv2')
@section('title', 'Data Laporan')
@section('content')
    <div class="container">
        <a href="/data_laporan" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('data_laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Form group untuk Judul -->
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul" required>
                    </div>

                    <!-- Form group untuk Tanggal -->
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" required>
                    </div>

                    <!-- Form group untuk File PDF -->
                    <div class="form-group">
                        <label for="file_pdf">File PDF</label>
                        <input type="file" id="file_pdf" class="form-control" name="file_pdf" required>
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
