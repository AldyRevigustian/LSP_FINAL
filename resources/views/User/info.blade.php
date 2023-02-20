@extends('layouts.app')

@include('components.user')

@section('content')
    <style>
        input:read-only {
            background-color: white;
        }

        ;
    </style>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-center mb-3">
                    <h3>Identitas Aplikasi</h3>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{ $identitas->foto }}" alt=""
                    style="width: 200px;height: 200px;object-fit: cover; margin-bottom: 24px">
            </div>
            <table class="table">
                <tr>
                    <th style="width: 300px">Nama Aplikasi</th>
                    <td>
                        <input class="form-control" type="text" name="nama_app" readonly
                            value="{{ $identitas->nama_app }}">
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px">Alamat</th>
                    <td>
                        <textarea name="alamat_app" class="form-control" rows="8" readonly>{{ $identitas->alamat_app }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px">Email</th>
                    <td>
                        <input class="form-control" type="text" name="email_app" readonly
                            value="{{ $identitas->email_app }}">
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px">No Telepon</th>
                    <td>
                        <input class="form-control" type="number" name="nomor_telepon"
                            value="{{ $identitas->nomor_telepon }}" readonly>
                    </td>
                </tr>
            </table>
        </div>

    </div>
@endsection
