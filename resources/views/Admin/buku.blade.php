@extends('layouts.app')

@include('components.admin')

@section('content')
    <style>
        input:read-only {
            background-color: white;
            pointer-events: initial;
        }
    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row mt-5 mb-3">
                <div class="col-2 d-flex align-items-center">
                    <h1>Buku</h1>
                </div>
                <div class="col-10 d-flex align-items-center justify-content-end">
                    <div class="user-name text-end me-3">
                        <h6 class="mb-0 text-gray-600">{{ Auth::user()->nama }}</h6>
                        <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->kode }}</p>
                    </div>
                    <div class="avatar">
                        <img src="{{ Auth::user()->foto }}" style="height: 50px; width: 50px">
                    </div>
                </div>
            </div>
            @include('message')
        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Buku
                    </h5>
                    <hr>
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 'admin')
                        <a href="#" class="btn icon btn-primary text-light" data-bs-toggle="modal"
                            data-bs-target="#add"><i class="bi bi-plus-lg"></i> Add</a>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cover Buku</th>
                                <th>ISBN</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Jumlah Awal</th>
                                <th>Jumlah Sekarang</th>
                                <th>Tahun Terbit</th>
                                @if (Auth::user()->role == 'admin')
                                    <th class="col-1">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukus as $key => $buku)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ $buku->foto }}" alt=""
                                            style="max-width: 150px; max-height: 150px"></td>
                                    <td>{{ $buku->isbn }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->pengarang }}</td>
                                    <td>{{ $buku->jumlah_awal }}</td>
                                    <td>{{ $buku->stock }}</td>
                                    <td>{{ $buku->tahun_terbit }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <a href="#" class="btn icon btn-warning text-light" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $buku->id }}"><i
                                                    class="bi bi-pencil-fill"></i></a>
                                            <form class="d-inline" method="POST"
                                                action="{{ route('admin.destroy_buku', $buku->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn icon btn-danger"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>


    <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Buku</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store_buku') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label>Foto Buku: </label>
                        <div class="form-group">
                            <input type="file" accept="image/*" name="foto" class="form-control" required>
                        </div>

                        <label>ISBN: </label>
                        <div class="form-group">
                            <input type="number" placeholder="ISBN" class="form-control" name="isbn" required>
                        </div>

                        <label>Judul: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Judul Buku" class="form-control" name="judul" required>
                        </div>

                        <label>Kategori: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Kategori Buku" class="form-control" name="kategori" required>
                        </div>

                        <label>Pengarang: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Pengarang Buku" class="form-control" name="pengarang"
                                required>
                        </div>

                        <label>Tahun Terbit: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Tahun Terbit" class="form-control" name="tahun_terbit"
                                required>
                        </div>

                        <label>Jumlah: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Jumlah" class="form-control" name="jumlah" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <span class="d-none d-sm-block">Add</span>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($bukus as $buku)
        <div class="modal fade text-left" id="edit{{ $buku->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Buku</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.update_buku', $buku->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label>Foto Buku: </label>
                            <div class="form-group">
                                <input type="file" accept="image/*" name="foto" class="form-control">
                            </div>

                            <label>ISBN: </label>
                            <div class="form-group">
                                <input type="number" placeholder="ISBN" class="form-control" name="isbn" required
                                    value="{{ $buku->isbn }}">
                            </div>

                            <label>Judul: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Judul Buku" class="form-control" name="judul"
                                    required value="{{ $buku->judul }}">
                            </div>

                            <label>Kategori: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Kategori Buku" class="form-control" name="kategori"
                                    required value="{{ $buku->kategori }}">
                            </div>

                            <label>Pengarang: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Pengarang Buku" class="form-control" name="pengarang"
                                    required value="{{ $buku->pengarang }}">
                            </div>

                            <label>Tahun Terbit: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Tahun Terbit" class="form-control"
                                    name="tahun_terbit" required value="{{ $buku->tahun_terbit }}">
                            </div>

                            <label>Jumlah Awal: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Jumlah" class="form-control" name="jumlah" required
                                    value="{{ $buku->jumlah_awal }}">
                            </div>

                            <label>Jumlah Sekarang: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Jumlah" class="form-control" name="stock" required
                                    value="{{ $buku->stock }}">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
