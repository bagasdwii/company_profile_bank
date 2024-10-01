@extends('layouts.appv2')
@section('title', 'Detail Data Produk')
@section('content')
    <div class="container">
        <a href="/data_produk" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataProduk->judul }}</p>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <p id="keterangan" class="form-control-plaintext">{{ $dataProduk->keterangan }}</p>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataProduk->gambar) }}" alt="{{ $dataProduk->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
