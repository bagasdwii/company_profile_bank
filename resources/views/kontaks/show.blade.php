@extends('layouts.appv2')
@section('title', 'Detail Data Kontak')
@section('content')
    <div class="container">
        <a href="/data_kontak" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="nama">Email</label>
                    <p id="nama" class="form-control-plaintext">{{ $dataKontak->email }}</p>
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <p id="telepon" class="form-control-plaintext">{{ $dataKontak->telepon }}</p>
                </div>
                <div class="form-group">
                    <label for="telepon">Whatapps</label>
                    <p id="telepon" class="form-control-plaintext">{{ $dataKontak->no_wa }}</p>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <p id="alamat" class="form-control-plaintext">{{ $dataKontak->alamat }}</p>
                </div>

                <div class="form-group">
                    <label for="gmap">Link Gmap</label>
                    <p id="gmap" class="form-control-plaintext">{{ $dataKontak->gmap }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection