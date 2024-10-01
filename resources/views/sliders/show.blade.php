@extends('layouts.appv2')
@section('title', 'Detail Data Slider')
@section('content')
    <div class="container">
        <a href="/data_slider" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataSlider->judul }}</p>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <p id="keterangan" class="form-control-plaintext">{{ $dataSlider->keterangan }}</p>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataSlider->gambar) }}" alt="{{ $dataSlider->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
