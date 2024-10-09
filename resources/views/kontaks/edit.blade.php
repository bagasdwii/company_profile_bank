@extends('layouts.appv2')
@section('title', 'Data Kontak')
@section('content')
    <div class="container">
        <a href="/data_kontak" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_kontak.update', $dataKontak->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <form-group>
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="Email"  value="{{ $dataKontak->email }}">
                    </form-group>
                    </form-group><form-group>
                        <label for="telepon">Nomor Telepon</label>
                        <input type="number" id="telepon" class="form-control" name="telepon" placeholder="Nomor Telepon"  value="{{ $dataKontak->telepon }}">
                    </form-group>
                    </form-group><form-group>
                        <label for="no_wa">Whatapps</label>
                        <input type="number" id="no_wa" class="form-control" name="no_wa" placeholder="Nomor Whatapps"  value="{{ $dataKontak->no_wa }}">
                    </form-group>
                    <form-group>
                        <label for="alamat">Alamat</label>
                        <textarea type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat"  >{{ $dataKontak->alamat }}</textarea>
                    </form-group>
                    <form-group>
                        <label for="gmap">Gmap</label>
                        <input type="text" id="gmap" class="form-control" name="gmap" placeholder="Link Gmap"  value="{{ $dataKontak->gmap }}">
                    </form-group>
                    <form-group>
                        <button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
                    </form-group>
                </form>
            </div>
        </div>
    </div>
@endsection