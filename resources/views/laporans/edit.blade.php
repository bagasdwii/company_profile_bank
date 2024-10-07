@extends('layouts.appv2')
@section('title', 'Data Laporan')
@section('content')
    <div class="container">
        <a href="/data_laporan" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_laporan.update', $dataLaporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <form-group>
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul"  value="{{ $dataLaporan->judul }}">
                    </form-group>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" value="{{ $dataLaporan->tanggal}}">
                    </div>
                    <!-- Menggunakan link untuk membuka PDF di tab baru -->
                    <a href="{{ Storage::url($dataLaporan->file_pdf) }}" target="_blank">
                        Lihat PDF
                    </a><br>
                    <form-group>
                        <label for="file_pdf">PDF</label>
                        <input type="file" id="file_pdf" class="form-control" name="file_pdf"  >
                    </form-group>
                    <form-group>
                        <button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
                    </form-group>
                </form>
            </div>
        </div>
    </div>
@endsection