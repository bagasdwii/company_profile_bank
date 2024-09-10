@extends('layouts.appv2')
@section('title', 'Data Produk')
@section('content')
    <div class="container">
        <a href="/data_produk" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form-group>
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul" required>
                    </form-group>
                    <form-group>
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan" required></textarea>
                    </form-group>
                    <form-group>
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" class="form-control" name="gambar" required>
                    </form-group>
                    <form-group>
                        <button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
                    </form-group>
                </form>
            </div>
        </div>
    </div>
@endsection