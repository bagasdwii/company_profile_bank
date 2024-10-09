@extends('layouts.appv2')
@section('title', 'Data Kontak')
@section('content')
    <div class="container">
        <a href="/data_kontak" class="mb-3 btn btn-primary">Kembali</a>
        <div class="row">
            <div class="col-md-12">
                <form  action="{{ route('data_kontak.store') }}" method="POST">
                    @csrf
                    <form-group>
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="Email" required>
                    </form-group>
                    </form-group><form-group>
                        <label for="telepon">Telepon</label>
                        <input type="number" id="telepon" class="form-control" name="telepon" placeholder="Nomor Telepon" required>
                    </form-group>
                    </form-group><form-group>
                        <label for="no_wa">Whatapps</label>
                        <input type="number" id="no_wa" class="form-control" name="no_wa" placeholder="Nomor Telepon" required>
                    </form-group>
                    <form-group>
                        <label for="alamat">Alamat</label>
                        <textarea type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                    </form-group>
                    <form-group>
                        <label for="gmap">Gmap</label>
                        <input type="text" id="gmap" class="form-control" name="gmap" placeholder="Link Gmap" required>
                    <form-group>
                        <button type="submit" class="btn btn-primary btn-block my-3">Submit</button>
                    </form-group>
                </form>
            </div>
        </div>
    </div>
@endsection