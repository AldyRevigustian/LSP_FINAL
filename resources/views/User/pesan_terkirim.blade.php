@extends('layouts.app')

@include('components.user')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Pesan Terkirim</h3>
                </div>
            </div>
            @include('message')
        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Pesan Terkirim
                    </h5>
                    <hr>
                </div>
                <div class="card-body">
                    <a class="btn icon icon-left btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add"><i
                            class="bi bi-plus-lg"></i>Kirim Pesan</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Penerima</th>
                                <th>Judul Pesan</th>
                                <th>Isi Pesan</th>
                                <th class="col-1">Status</th>
                                <th class="col-2">Tanggal Kirim</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesans as $key => $pesan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pesan->penerima->fullname }}</td>
                                    <td>{{ $pesan->judul }}</td>
                                    <td>{{ $pesan->isi }}</td>
                                    <td>{{ Str::ucfirst($pesan->status) }}</td>
                                    <td>{{ $pesan->tanggal_kirim }}</td>
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
                    <h4 class="modal-title" id="myModalLabel33">Kirim Pesan </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.kirim_pesan') }}" method="POST">
                        @csrf
                        <label for="">Penerima : </label>
                        <div class="form-group">
                            <select name="penerima_id" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Penerima--</option>
                                @foreach ($penerimas as $penerima)
                                    <option value="{{ $penerima->id }}">
                                        {{ $penerima->fullname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <label>Judul Pesan: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Judul Pesan"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}" name="judul"
                                required>
                        </div>
                        <label>Isi Pesan: </label>
                        <div class="form-group">
                            <textarea rows="5" placeholder="Isi Pesan" class="form-control {{ $errors->has('isi') ? 'is-invalid' : '' }}"
                                name="isi" required></textarea>
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
@endsection
