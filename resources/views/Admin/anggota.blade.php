@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Anggota</h3>
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
                                <th>Kode Anggota</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th class="col-2">Status</th>
                                <th class="col-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggotas as $key => $anggota)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $anggota->kode }}</td>
                                    <td>{{ $anggota->nis }}</td>
                                    <td>{{ $anggota->fullname }}</td>
                                    <td>{{ $anggota->kelas }}</td>
                                    <td>{{ $anggota->alamat }}</td>
                                    <td>
                                        <span
                                            class="badge d-flex justify-content-center bg-{{ $anggota->verif == 'verified' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($anggota->verif) }}
                                    </td>
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
                    <form action="{{ route('admin.store_anggota') }}" method="POST">
                        @csrf
                        <label>NIS: </label>
                        <div class="form-group">
                            <input type="number" placeholder="NIS Anggota" class="form-control" name="nis" required>
                        </div>
                        <label>Full Name: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Full Name" class="form-control" name="fullname" required>
                        </div>
                        <label>User Name: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="username" required>
                        </div>
                        <label>Password: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password" required>
                        </div>
                        <label>Kelas: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Kelas" class="form-control" name="kelas" required>
                        </div>
                        <label>Alamat: </label>
                        <div class="form-group">
                            <textarea rows="5" placeholder="Alamat" class="form-control" name="alamat" required></textarea>
                        </div>
                        <label>Status: </label>
                        <div class="form-group">
                            <select name="verif" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Status--</option>
                                <option value="verified">Verified</option>
                                <option value="unverified">Unverified</option>
                            </select>
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
                        <form action="{{ route('admin.update_anggota', $anggota->id) }}" method="POST">
                            @csrf
                            <label>NIS: </label>
                            <div class="form-group">
                                <input type="number" placeholder="NIS Anggota" class="form-control" name="nis"
                                    required value="{{ $anggota->nis }}">
                            </div>
                            <label>Full Name: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Full Name" class="form-control" name="fullname"
                                    required value="{{ $anggota->fullname }}">
                            </div>
                            <label>User Name: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Username" class="form-control" name="username"
                                    required value="{{ $anggota->username }}">
                            </div>
                            <label>Kelas: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Kelas" class="form-control" name="kelas" required
                                    value="{{ $anggota->kelas }}">
                            </div>
                            <label>Alamat: </label>
                            <div class="form-group">
                                <textarea placeholder="Alamat" rows="5" class="form-control" name="alamat" required>{{ $anggota->alamat }}</textarea>
                            </div>
                            <label>Status: </label>
                            <div class="form-group">
                                <select name="verif" class="form-select">
                                    <option value="{{ $anggota->verif }}" selected>{{ ucfirst($anggota->verif) }}
                                    </option>
                                    @if ($anggota->verif == 'verified')
                                        <option value="unverified">Unverified</option>
                                    @endif
                                    @if ($anggota->verif == 'unverified')
                                        <option value="verified">Verified</option>
                                    @endif
                                </select>
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
