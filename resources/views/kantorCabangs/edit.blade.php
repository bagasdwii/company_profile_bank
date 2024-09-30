@extends('layouts.appv2')
@section('title', 'Data Kantor Cabang')
@section('content')
    <div class="container">
        <a href="/data_kantor_cabang" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_kantor_cabang.update', $dataKantorCabang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <form-group>
                        <label for="nama">Nama Cabang</label>
                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama"  value="{{ $dataKantorCabang->nama }}">
                    </form-group>
                    <form-group>
                        <label for="alamat">Alamat</label>
                        <textarea type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat"  >{{ $dataKantorCabang->alamat }}</textarea>
                    </form-group>
                    <form-group>
                        <label for="gmap">Gmap</label>
                        <input type="text" id="gmap" class="form-control" name="gmap" placeholder="Link Gmap"  value="{{ $dataKantorCabang->gmap }}">
                    </form-group><form-group>
                        <label for="telepon">Nomor Telepon</label>
                        <input type="text" id="telepon" class="form-control" name="telepon" placeholder="Nomor Telepon"  value="{{ $dataKantorCabang->telepon }}">
                    </form-group>
                    <img class="img-fluid rounded mx-auto d-block my-3" src="/assets/data_kantor_cabang/{{ $dataKantorCabang->gambar }}" alt="">
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