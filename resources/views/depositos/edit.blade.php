@extends('layouts.appv2')
@section('title', 'Data Deposito')
@section('content')
    <div class="container">
        <a href="/data_deposito" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_deposito.update', $dataDeposito->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <form-group>
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul"  value="{{ $dataDeposito->judul }}">
                    </form-group>
                    <form-group>
                        <label for="keterangan">Keterangan</label>
                        <textarea type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan"  >{{ $dataDeposito->keterangan }}</textarea>
                    </form-group>
                    <form-group>
                        <label for="nama_button">Nama Button</label>
                        <input type="text" id="nama_button" class="form-control" name="nama_button" placeholder="Nama Button"  value="{{ $dataDeposito->nama_button }}">
                    </form-group><form-group>
                        <label for="nomor_button">Nomor Button</label>
                        <input type="number" id="nomor_button" class="form-control" name="nomor_button" placeholder="Nomor Button"  value="{{ $dataDeposito->nomor_button }}">
                    </form-group>
                    <img class="img-fluid rounded mx-auto d-block my-3" src="{{ Storage::url($dataDeposito->gambar) }}" alt="">
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