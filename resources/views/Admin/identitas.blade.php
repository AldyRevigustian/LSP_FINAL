@extends('layouts.app')

@include('components.admin')

@section('content')
    <style>
        input:read-only {
            background-color: white;
            pointer-events: all
        }

        ;
    </style>
    <div class="row mt-5 mb-3">
        <div class="col-2 d-flex align-items-center">
            <h1>Settings</h1>
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

    <form action="{{ route('admin.update_identitas') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img src="{{ $identitas->foto }}" style="max-width: 200px; height: 180px; margin-bottom:24px" alt="Logo">
                </div>
                <table class="table">
                    <tr>
                        <th>Foto Profil</th>
                        <td>
                            <input type="file" accept="image/*" name="foto" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Aplikasi</th>
                        <td>
                            <input class="form-control" type="text" name="nama_app" value="{{ $identitas->nama_app }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Denda Telat (Rp.)</th>
                        <td>
                            <input class="form-control" type="number" name="denda_telat"
                                value="{{ $identitas->denda_telat }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Denda Rusak (Rp.)</th>
                        <td>
                            <input class="form-control" type="number" name="denda_rusak"
                                value="{{ $identitas->denda_rusak }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Denda Hilang (Rp.)</th>
                        <td>
                            <input class="form-control" type="number" name="denda_hilang"
                                value="{{ $identitas->denda_hilang }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Maximum Peminjaman</th>
                        <td>
                            <input class="form-control" type="number" name="max_pinjam"
                                value="{{ $identitas->max_pinjam }}">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form>
@endsection
