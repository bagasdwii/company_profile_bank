@extends('layouts.appv2')
@section('title', 'Detail Data Berita')
@section('content')
    <div class="container">
        <a href="/data_berita" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataBerita->judul }}</p>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <p id="keterangan" class="form-control-plaintext">{{ $dataBerita->keterangan }}</p>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <p id="tanggal" class="form-control-plaintext">{{ $dataBerita->tanggal }}</p>
                </div>

                <div class="form-group">
                    <label for="hari">Hari</label>
                    <p id="hari" class="form-control-plaintext">{{ $dataBerita->hari }}</p>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataBerita->gambar) }}" alt="{{ $dataBerita->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
