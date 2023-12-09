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
                    <h1>Anggota</h1>
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
                        List Anggota
                    </h5>
                    <hr>
                </div>
                <div class="card-body">
                    <a href="#" class="btn icon btn-primary text-light" data-bs-toggle="modal" data-bs-target="#add"><i
                            class="bi bi-plus-lg"></i>Add</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Profile</th>
                                <th>Kode Anggota</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th class="col-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggotas as $key => $anggota)
                                <tr>
                                    <td style="width: 70px">{{ $key + 1 }}</td>
                                    <td style="width: 80px"><img class="avatar" src="{{ $anggota->foto }}" alt=""
                                            style="width: 80px; height: 80px; object-fit: cover"></td>
                                    <td>{{ $anggota->kode }}</td>
                                    <td>{{ $anggota->nama }}</td>
                                    <td>{{ $anggota->email }}</td>
                                    <td>
                                        <a href="#" class="btn icon btn-warning text-light" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $anggota->id }}"><i class="bi bi-pencil-fill"></i></a>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.destroy_anggota', $anggota->id) }}">
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Anggota</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store_anggota') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label>Foto Profile: </label>
                        <div class="form-group">
                            <input type="file" accept="image/*" name="foto" class="form-control" required>
                        </div>
                        <label>Kode: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Kode Anggota" class="form-control" name="kode" required>
                        </div>
                        <label>Nama: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Nama" class="form-control" name="nama" required>
                        </div>
                        <label>Email: </label>
                        <div class="form-group">
                            <input type="email" placeholder="Email" class="form-control" name="email" required>
                        </div>
                        <label>Password: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password" required>
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

    @foreach ($anggotas as $anggota)
        <div class="modal fade text-left" id="edit{{ $anggota->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Anggota</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.update_anggota', $anggota->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label>Change Profile: </label>
                            <div class="form-group">
                                <input type="file" accept="image/*" name="foto" class="form-control"
                                    value="{{ $anggota->foto }}">
                            </div>
                            <label>Kode: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Kode Anggota" class="form-control" name="kode"
                                    required value="{{ $anggota->kode }}">
                            </div>
                            <label>Nama: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama" class="form-control" name="nama" required
                                    value="{{ $anggota->nama }}">
                            </div>
                            <label>Email: </label>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control" name="email" required
                                    value="{{ $anggota->email }}">
                            </div>
                            <label>Password: </label>
                            <div class="form-group">
                                <input type="password" placeholder="Reset Password" class="form-control"
                                    name="password">
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
