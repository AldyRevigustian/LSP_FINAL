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
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Buku</h3>
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
                    <a href="#" class="btn icon btn-primary text-light" data-bs-toggle="modal" data-bs-target="#add"><i
                            class="bi bi-plus-lg"></i> Add</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th class="col-1">Buku Baik</th>
                                <th class="col-1">Buku Rusak</th>
                                <th class="col-1">Jumlah Buku</th>
                                <th class="col-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukus as $key => $buku)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ $buku->foto }}" alt="" height="100" width="100"></td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->pengarang }}</td>
                                    <td>{{ $buku->penerbit->nama }}</td>
                                    <td>{{ $buku->j_buku_baik }}</td>
                                    <td>{{ $buku->j_buku_rusak }}</td>
                                    <td>{{ $buku->j_buku_baik + $buku->j_buku_rusak }}</td>
                                    <td>
                                        <a href="#" class="btn icon btn-warning text-light" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $buku->id }}"><i class="bi bi-pencil-fill"></i></a>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.destroy_buku', $buku->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn icon btn-danger"><i
                                                    class="bi bi-trash-fill"></i></a>
                                        </form>
                                    </td>
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
                        <label>Judul: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Judul Buku" class="form-control" name="judul" required>
                        </div>

                        <label>Kategori: </label>
                        <div class="form-group">
                            <select name="kategori_id" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Kategori--</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="">Penerbit : </label>
                        <div class="form-group">
                            <select name="penerbit_id" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Penerbit--</option>
                                @foreach ($penerbits as $penerbit)
                                    <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label>Pengarang: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Pengarang Buku" class="form-control" name="pengarang"
                                required>
                        </div>

                        <label>Tahun Terbit: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Tahun Terbit" class="form-control" name="tahun_terbit"
                                required>
                        </div>

                        <label>Isbn: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Isbn" class="form-control" name="isbn" required>
                        </div>

                        <label>Jumlah Buku Baik: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Jumlah Buku Baik" class="form-control" name="j_buku_baik"
                                required>
                        </div>

                        <label>Jumlah Buku Rusak: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Jumlah Buku Rusak" class="form-control" name="j_buku_rusak"
                                required>
                        </div>

                        <label>Foto Buku: </label>
                        <div class="form-group">
                            <input type="file" accept="image/*" name="foto" class="form-control" required>
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
                            <label>Judul: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Judul Buku" class="form-control" name="judul"
                                    required value="{{ $buku->judul }}">
                            </div>

                            <label>Kategori: </label>
                            <div class="form-group">
                                <select name="kategori_id" class="form-select">
                                    <option value="{{ $buku->kategori_id }}" selected>{{ $buku->kategori->nama }}
                                    </option>
                                    @foreach ($kategoris as $kategori)
                                        @if ($kategori->id != $buku->kategori_id)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <label for="">Penerbit : </label>
                            <div class="form-group">
                                <select name="penerbit_id" class="form-select">
                                    <option value="{{ $buku->penerbit_id }}" selected>{{ $buku->penerbit->nama }}
                                    </option>
                                    @foreach ($penerbits as $penerbit)
                                        @if ($penerbit->id != $buku->penerbit_id)
                                            <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <label>Pengarang: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Pengarang Buku" class="form-control" name="pengarang"
                                    required value="{{ $buku->pengarang }}">
                            </div>

                            <label>Tahun Terbit: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Tahun Terbit" class="form-control"
                                    name="tahun_terbit" required value="{{ $buku->tahun_terbit }}">
                            </div>

                            <label>Isbn: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Isbn" class="form-control" name="isbn" required
                                    value="{{ $buku->isbn }}">
                            </div>

                            <label>Jumlah Buku Baik: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Jumlah Buku Baik" class="form-control"
                                    name="j_buku_baik" required value="{{ $buku->j_buku_baik }}">
                            </div>

                            <label>Jumlah Buku Rusak: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Jumlah Buku Rusak" class="form-control"
                                    name="j_buku_rusak" required value="{{ $buku->j_buku_rusak }}">
                            </div>

                            <label>Foto Buku: </label>
                            <div class="form-group">
                                <input type="file" accept="image/*" name="foto" class="form-control">
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
