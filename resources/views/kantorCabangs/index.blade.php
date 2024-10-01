@extends('layouts.appv2')
@section('title', 'Data Kantor Cabang')
@section('content')
    <div class="container">
        <a href="/data_kantor_cabang/create" class="mb-3 btn btn-primary">Tambah Data</a>
        @if (($message = Session::get('message')))
            <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Form Pencarian -->
        <form method="GET" action="{{ url('/data_kantor_cabang') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Kantor Cabang..." value="{{ $search }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered border-light table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Cabang</th>
                        <th style="width: 30%;">Alamat</th>
                        <th style="width: 15%;">Telepon</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = ($kantorCabangs->currentPage() - 1) * $kantorCabangs->perPage() + 1;
                    @endphp
                    @foreach ($kantorCabangs as $kantorCabang)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $kantorCabang->nama }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $kantorCabang->alamat }}</td>
                        <td class="text-truncate" style="max-width: 50px;">{{ $kantorCabang->telepon }}</td>

                        <td>
                            <img class="img-fluid rounded mx-auto d-block" src="{{ Storage::url($kantorCabang->gambar) }}" alt="" style="max-width: 90px;" data-bs-toggle="modal" data-bs-target="#modalGambar{{ $kantorCabang->id }}">
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <div class="d-flex mb-2">
                                    <a href="{{ route('data_kantor_cabang.show', $kantorCabang->id) }}" class="btn btn-info btn-sm me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('data_kantor_cabang.edit', $kantorCabang->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
    
                                    <!-- Tombol Hapus -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $kantorCabang->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus{{ $kantorCabang->id }}" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus kantorCabang dengan judul "{{ $kantorCabang->nama }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('data_kantor_cabang.destroy', $kantorCabang->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    {{-- <a href="{{ route('data_kantor_kas', $kantorCabang->id) }}" class="btn btn-success btn-sm w-100">
                                        Kantor Kas
                                    </a> --}}
                                </div>
                            </div>
                        </td>
                      
                    </tr>

                    <!-- Modal Gambar kantorCabang -->
                    <div class="modal fade" id="modalGambar{{ $kantorCabang->id }}" tabindex="-1" aria-labelledby="modalGambarLabel{{ $kantorCabang->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalGambarLabel{{ $kantorCabang->id }}">Gambar kantorCabang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="img-fluid" src="{{ Storage::url($kantorCabang->gambar) }}" alt="Gambar kantorCabang">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $kantorCabangs->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
