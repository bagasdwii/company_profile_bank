@extends('layouts.appv2')
@section('title', 'Data Berita')
@section('content')
    <div class="container">
        <a href="/data_berita" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_berita.update', $dataBerita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <form-group>
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul"  value="{{ $dataBerita->judul }}">
                    </form-group>
                    <form-group>
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan"  >{{ $dataBerita->keterangan }}</textarea>
                    </form-group>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" value="{{ $dataBerita->tanggal}}">
                    </div>
                    <img class="img-fluid rounded mx-auto d-block my-3" src="{{ Storage::url($dataBerita->gambar) }}" alt="">
                    <form-group>
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" class="form-control" name="gambar"  >
                    </form-group>
                    <form-group>
                        <button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
                    </form-group>
                </form>
            </div>
        </div>
    </div>
@endsection