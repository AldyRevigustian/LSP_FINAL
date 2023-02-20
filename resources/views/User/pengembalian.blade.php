@extends('layouts.app')

@include('components.user')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Pengembalian</h3>
                </div>
            </div>
            @include('message')
        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Pengembalian
                    </h5>
                    <hr>
                </div>
                <div class="card-body">
                    <a href="#" class="btn icon btn-primary text-light" data-bs-toggle="modal" data-bs-target="#add"><i
                            class="bi bi-plus-lg"></i>Tambah Pengembalian   </a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Kondisi Buku Saat Dipinjam</th>
                                <th>Kondisi Buku Saat Dikembalikan</th>
                                <th class="col-1">Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengembalians as $key => $pengembalian)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pengembalian->user->fullname }}</td>
                                    <td>{{ $pengembalian->buku->judul }}</td>
                                    <td>{{ $pengembalian->tanggal_peminjaman }}</td>
                                    <td>{{ $pengembalian->tanggal_pengembalian ?? '-' }}</td>
                                    <td>{{ Str::ucfirst($pengembalian->kondisi_buku_saat_dipinjam) }}</td>
                                    <td>{{ Str::ucfirst($pengembalian->kondisi_buku_saat_dikembalikan) ?? '-' }}</td>
                                    <td>{{ $pengembalian->denda ?? '-' }}</td>
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Pengembalian</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store_pengembalian') }}" method="POST">
                        @csrf
                        <label>Pilih Peminjaman: </label>
                        <div class="form-group">
                            <select name="peminjaman_id" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Peminjaman--</option>
                                @foreach ($peminjamans as $peminjaman)
                                <option value="{{ $peminjaman->id }}">{{ $peminjaman->buku->judul }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label>Tanggal Pengembalian: </label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="tanggal_pengembalian" readonly value="{{ date('Y-m-d') }}">
                        </div>

                        <label>Pilih Kondisi : </label>
                        <div class="form-group">
                            <select name="kondisi_buku_saat_dikembalikan" class="form-select">
                                <option value="" disabled selected>
                                    --Pilih Kondisi--</option>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                                <option value="hilang">Hilang</option>
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
@endsection
