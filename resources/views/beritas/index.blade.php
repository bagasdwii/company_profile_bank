@extends('layouts.appv2')
@section('title', 'Data Berita')
@section('content')
    <div class="container">
        <a href="/data_berita/create" class="mb-3 btn btn-primary">Tambah Data</a>
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
                        <th style="width: 25%;">Keterangan</th>
                        <th style="width: 20;">Tanggal</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($beritas as $berita)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $berita->judul }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $berita->keterangan }}</td>
                        <td class="text-truncate" style="max-width: 100px;">{{ $berita->hari }}, {{ $berita->tanggal }}</td>
                        <td>
                            <img class="img-fluid rounded mx-auto d-block" src="assets/data_berita/{{ $berita->gambar }}" alt="" style="max-width: 90px;">
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('data_berita.edit', $berita->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $berita->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="modalHapus{{ $berita->id }}" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus berita dengan judul "{{ $berita->judul }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('data_berita.destroy', $berita->id) }}" method="POST">
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
