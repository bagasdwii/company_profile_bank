@extends('layouts.appv2')
@section('title', 'Data Edukasi')
@section('content')
    <div class="container">
        <a href="/data_edukasi/create" class="mb-3 btn btn-primary">Tambah Data</a>
        @if (($message = Session::get('message')))
            <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Form Pencarian -->
        <form method="GET" action="{{ url('/data_edukasi') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Edukasi..." value="{{ $search }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered border-light table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Judul</th>
                        <th style="width: 20%;">Keterangan</th>
                        <th style="width: 20;">Tanggal</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = ($edukasis->currentPage() - 1) * $edukasis->perPage() + 1;
                    @endphp
                    @foreach ($edukasis as $edukasi)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $edukasi->judul }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $edukasi->keterangan }}</td>
                        <td class="text-truncate" style="max-width: 100px;">{{ $edukasi->hari }}, {{ $edukasi->tanggal }}</td>
                        <td>
                            <img class="img-fluid rounded mx-auto d-block" src="{{ Storage::url($edukasi->gambar)}}" alt="" style="max-width: 90px;" data-bs-toggle="modal" data-bs-target="#modalGambar{{ $edukasi->id }}">
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('data_edukasi.show', $edukasi->id) }}" class="btn btn-info btn-sm me-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('data_edukasi.edit', $edukasi->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $edukasi->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="modalHapus{{ $edukasi->id }}" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus edukasi dengan judul "{{ $edukasi->judul }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('data_edukasi.destroy', $edukasi->id) }}" method="POST">
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

                    <!-- Modal Gambar edukasi -->
                    <div class="modal fade" id="modalGambar{{ $edukasi->id }}" tabindex="-1" aria-labelledby="modalGambarLabel{{ $edukasi->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalGambarLabel{{ $edukasi->id }}">Gambar edukasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="img-fluid" src="{{ Storage::url($edukasi->gambar) }}" alt="Gambar edukasi">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $edukasis->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

