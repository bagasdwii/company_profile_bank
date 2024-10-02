@extends('layouts.appv2')
@section('title', 'Detail Data Kantor Kas')
@section('content')
    <div class="container">
        <a href="/data_kantor_cabang/{{ $idkantorcabang }}/data_kantor_kas" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="nama">Kas</label>
                    <p id="nama" class="form-control-plaintext">{{ $dataKantorKas->nama }}</p>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <p id="alamat" class="form-control-plaintext">{{ $dataKantorKas->alamat }}</p>
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <p id="telepon" class="form-control-plaintext">{{ $dataKantorKas->telepon }}</p>
                </div>

                <div class="form-group">
                    <label for="gmap">Link Gmap</label>
                    <p id="gmap" class="form-control-plaintext">{{ $dataKantorKas->gmap }}</p>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataKantorKas->gambar) }}" alt="{{ $dataKantorKas->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
