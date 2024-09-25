@extends('layouts.appv2')
@section('title', 'Data Kredit')
@section('content')
    <div class="container">
        <a href="/data_kredit/create" class="mb-3 btn btn-primary">Tambah Data</a>
        @if (($message = Session::get('message')))
            <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Form Pencarian -->
        <form method="GET" action="{{ url('/data_kredit') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari kredit..." value="{{ $search }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered border-light table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Judul</th>
                        <th style="width: 35%;">Keterangan</th>
                        <th style="width: 5%;">Button</th>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = ($kredits->currentPage() - 1) * $kredits->perPage() + 1;
                    @endphp
                    @foreach ($kredits as $kredit)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $kredit->judul }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $kredit->keterangan }}</td>
                        <td class="text-truncate" style="max-width: 50px;">{{ $kredit->nama_button }}</td>
                        <td class="text-truncate" style="max-width: 50px;">{{ $kredit->nomor_button }}</td>

                        <td>
                            <img class="img-fluid rounded mx-auto d-block" src="assets/data_kredit/{{ $kredit->gambar }}" alt="" style="max-width: 90px;" data-bs-toggle="modal" data-bs-target="#modalGambar{{ $kredit->id }}">
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('data_kredit.edit', $kredit->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $kredit->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="modalHapus{{ $kredit->id }}" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus kredit dengan judul "{{ $kredit->judul }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('data_kredit.destroy', $kredit->id) }}" method="POST">
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

                    <!-- Modal Gambar kredit -->
                    <div class="modal fade" id="modalGambar{{ $kredit->id }}" tabindex="-1" aria-labelledby="modalGambarLabel{{ $kredit->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalGambarLabel{{ $kredit->id }}">Gambar kredit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="img-fluid" src="assets/data_kredit/{{ $kredit->gambar }}" alt="Gambar kredit">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $kredits->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
