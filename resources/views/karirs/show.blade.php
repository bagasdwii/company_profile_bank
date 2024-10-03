@extends('layouts.appv2')
@section('title', 'Detail Data Karir')
@section('content')
    <div class="container">
        <a href="/data_karir" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data karir -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataKarir->judul }}</p>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <p id="keterangan" class="form-control-plaintext">{{ $dataKarir->keterangan }}</p>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <p id="tanggal" class="form-control-plaintext">{{ $dataKarir->tanggal }}</p>
                </div>

                <div class="form-group">
                    <label for="hari">Hari</label>
                    <p id="hari" class="form-control-plaintext">{{ $dataKarir->hari }}</p>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <img src="{{ Storage::url($dataKarir->gambar) }}" alt="{{ $dataKarir->judul }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
