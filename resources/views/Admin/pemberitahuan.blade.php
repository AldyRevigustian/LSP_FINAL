@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Pemberitahuan</h3>
                </div>
            </div>
            @include('message')
        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Pemberitahuan
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
                                <th>Isi</th>
                                <th>Status</th>
                                <th class="col-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemberitahuans as $key => $pemberitahuan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pemberitahuan->isi }}</td>
                                    <td>
                                        <span
                                            class="badge d-flex justify-content-center bg-{{ $pemberitahuan->status == 'aktif' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($pemberitahuan->status) }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-warning text-light" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $pemberitahuan->id }}"><i class="bi bi-pencil-fill"></i></a>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.destroy_pemberitahuan', $pemberitahuan->id) }}">
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Pemberitahuan</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store_pemberitahuan') }}" method="POST">
                        @csrf
                        <label>Isi: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Isi Pemberitahuan" class="form-control" name="isi" required>
                        </div>

                        <label>Status: </label>
                        <div class="form-group">
                            <select name="status" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Kategori--</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
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

    @foreach ($pemberitahuans as $pemberitahuan)
        <div class="modal fade text-left" id="edit{{ $pemberitahuan->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Pemberitahuan</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.update_pemberitahuan', $pemberitahuan->id) }}" method="POST">
                            @csrf
                            <label>Isi Pemberitahuan: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Isi Pemberitahuan" class="form-control" name="isi" required
                                    value="{{ $pemberitahuan->isi }}">
                            </div>

                            <label>Status: </label>
                            <div class="form-group">
                                <select name="status" class="form-select">
                                    <option value="{{ $pemberitahuan->status }}" selected>{{ ucfirst($pemberitahuan->status) }}
                                    </option>
                                    @if ($pemberitahuan->status == 'aktif')
                                        <option value="nonaktif">Nonaktif</option>
                                    @endif
                                    @if ($pemberitahuan->status == 'nonaktif')
                                        <option value="aktif">Aktif</option>
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
