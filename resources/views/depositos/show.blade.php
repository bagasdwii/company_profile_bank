@extends('layouts.appv2')
@section('title', 'Detail Data Deposito')
@section('content')
    <div class="container">
        <a href="/data_deposito" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data Berita -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataDeposito->judul }}</p>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <p id="keterangan" class="form-control-plaintext">{{ $dataDeposito->keterangan }}</p>
                </div>

                <div class="form-group">
                    <label for="nama_button">Nama Button</label>
                    <p id="nama_button" class="form-control-plaintext">{{ $dataDeposito->nama_button }}</p>
                </div>

                <div class="form-group">
                    <label for="nomor_button">Nomor Button</label>
                    <p id="nomor_button" class="form-control-plaintext">{{ $dataDeposito->nomor_button }}</p>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataDeposito->gambar) }}" alt="{{ $dataDeposito->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
