@extends('layouts.appv2')
@section('title', 'Detail Data Laporan')
@section('content')
    <div class="container">
        <a href="/data_laporan" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <!-- Tampilkan detail Data laporan -->
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <p id="judul" class="form-control-plaintext">{{ $dataLaporan->judul }}</p>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <p id="tanggal" class="form-control-plaintext">{{ $dataLaporan->tanggal }}</p>
                </div>

                <div class="form-group">
                    <label for="hari">Hari</label>
                    <p id="hari" class="form-control-plaintext">{{ $dataLaporan->hari }}</p>
                </div>

                <div class="form-group">
                    <label for="file_pdf">PDF</label>
                    <!-- Menggunakan link untuk membuka PDF di tab baru -->
                    <a href="{{ Storage::url($dataLaporan->file_pdf) }}" target="_blank">
                        Lihat PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
