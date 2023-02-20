@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Penerbit</h3>
                </div>
            </div>
            @include('message')
        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Penerbit
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
                                <th>Kode Penerbit</th>
                                <th>Nama Penerbit</th>
                                <th class="col-2">Status</th>
                                <th class="col-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penerbits as $key => $penerbit)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $penerbit->kode }}</td>
                                    <td>{{ $penerbit->nama }}</td>
                                    <td>
                                        <span
                                            class="badge d-flex justify-content-center bg-{{ $penerbit->verif == 'verified' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($penerbit->verif) }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-warning text-light" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $penerbit->id }}"><i class="bi bi-pencil-fill"></i></a>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.destroy_penerbit', $penerbit->id) }}">
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Penerbit</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store_penerbit') }}" method="POST">
                        @csrf
                        <label>Nama Penerbit: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Nama Penerbit" class="form-control" name="nama" required>
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

    @foreach ($penerbits as $penerbit)
        <div class="modal fade text-left" id="edit{{ $penerbit->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Penerbit</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.update_penerbit', $penerbit->id) }}" method="POST">
                            @csrf
                            <label>Nama Penerbit: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama Penerbit" class="form-control" name="nama"
                                    required value="{{ $penerbit->nama }}">
                            </div>
                            <label>Status: </label>
                            <div class="form-group">
                                <select name="verif" class="form-select">
                                    <option value="{{ $penerbit->verif }}" selected>{{ ucfirst($penerbit->verif) }}
                                    </option>
                                    @if ($penerbit->verif == 'verified')
                                        <option value="unverified">Unverified</option>
                                    @endif
                                    @if ($penerbit->verif == 'unverified')
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
