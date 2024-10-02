@extends('layouts.appv2')
@section('title', 'Data Kantor Kas')
@section('content')
    <div class="container">
        <a href="/data_kantor_kas" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_kantor_kas.store',  $kantorCabang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form-group>
                        <label for="nama">Nama Kas</label>
                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" required>
                    </form-group>
                    <form-group>
                        <label for="alamat">Alamat</label>
                        <textarea type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                    </form-group>
                    <form-group>
                        <label for="gmap">Gmap</label>
                        <input type="text" id="gmap" class="form-control" name="gmap" placeholder="Link Gmap" required>
                    </form-group><form-group>
                        <label for="telepon">Telepon</label>
                        <input type="number" id="telepon" class="form-control" name="telepon" placeholder="Nomor Telepon" required>
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