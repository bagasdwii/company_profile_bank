@extends('layouts.appv2')
@section('title', 'Data Produk')
@section('content')
    <div class="container">
        <a href="/data_produk/create" class="mb-3 btn btn-primary">Tambah Data</a>
        @if (($message = Session::get('message')))
            <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered border-light table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Judul</th>
                        <th style="width: 45%;">Keterangan</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($produks as $produk)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $produk->judul }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $produk->keterangan }}</td>
                        <td>
                            <img class="img-fluid rounded mx-auto d-block" src="assets/data_produk/{{ $produk->gambar }}" alt="" style="max-width: 90px;">
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('data_produk.edit', $produk->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $produk->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="modalHapus{{ $produk->id }}" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus produk dengan judul "{{ $produk->judul }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('data_produk.destroy', $produk->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
