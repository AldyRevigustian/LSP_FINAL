@extends('layouts.app')

@include('components.admin')

@section('content')
    <style>
        input:read-only {
            background-color: white;
            pointer-events: all
        } ;
    </style>
    @include('message')

    <form action="{{ route('admin.update_identitas') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img src="{{ $identitas->foto }}" alt=""
                        style="width: 200px;height: 200px;object-fit: cover; margin-bottom: 24px">
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
                        <th>Alamat</th>
                        <td>
                            <textarea name="alamat_app" class="form-control" rows="8">{{ $identitas->alamat_app }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <input class="form-control" type="text" name="email_app" value="{{ $identitas->email_app }}">
                        </td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>
                            <input class="form-control" type="number" name="nomor_telepon"
                                value="{{ $identitas->nomor_telepon }}">
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
