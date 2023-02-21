@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Peminjaman</h3>
                </div>
            </div>
            @include('message')
        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Peminjaman
                    </h5>
                    <hr>
                </div>
                <div class="card-body">

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
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $key => $peminjaman)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $peminjaman->user->fullname }}</td>
                                    <td>{{ $peminjaman->buku->judul }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td>{{ $peminjaman->tanggal_pengembalian ?? '-' }}</td>
                                    <td>{{ Str::ucfirst($peminjaman->kondisi_buku_saat_dipinjam) ?? '-' }}</td>
                                    <td>{{ Str::ucfirst($peminjaman->kondisi_buku_saat_dikembalikan) ?? '-' }}</td>
                                    <td>{{ $peminjaman->denda ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
