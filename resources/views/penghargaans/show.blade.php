@extends('layouts.appv2')
@section('title', 'Detail Data Penghargaan')
@section('content')
    <div class="container">
        <a href="/data_penghargaan" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataPenghargaan->judul }}</p>
                </div>


                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataPenghargaan->gambar) }}" alt="{{ $dataPenghargaan->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
