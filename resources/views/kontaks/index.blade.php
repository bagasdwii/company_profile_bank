@extends('layouts.appv2')
@section('title', 'Data Kontak')
@section('content')
    <div class="container">
        <a href="/data_kontak/create" class="mb-3 btn btn-primary">Tambah Data</a>
        @if (($message = Session::get('message')))
            <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Form Pencarian -->
        <form method="GET" action="{{ url('/data_kontak') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Kontak..." value="{{ $search }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered border-light table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Email</th>
                        <th style="width: 20%;">Telepon</th>
                        <th style="width: 20%;">Whatapps</th>
                        <th style="width: 20%;">Alamat</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = ($kontaks->currentPage() - 1) * $kontaks->perPage() + 1;
                    @endphp
                    @foreach ($kontaks as $kontak)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $kontak->email }}</td>
                        <td class="text-truncate" style="max-width: 50px;">{{ $kontak->telepon }}</td>
                        <td class="text-truncate" style="max-width: 50px;">{{ $kontak->no_wa }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $kontak->alamat }}</td>

                        <td>
                            <div class="d-flex flex-column">
                                <div class="d-flex mb-2">
                                    <a href="{{ route('data_kontak.show', $kontak->id) }}" class="btn btn-info btn-sm me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('data_kontak.edit', $kontak->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
    
                                    <!-- Tombol Hapus -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $kontak->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus{{ $kontak->id }}" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus kontak dengan judul "{{ $kontak->email }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('data_kontak.destroy', $kontak->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
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

            <!-- Pagination Links -->
            {{ $kontaks->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection