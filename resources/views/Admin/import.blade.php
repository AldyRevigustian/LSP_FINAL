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
            <h1>Import</h1>
        </div>
        <div class="col-10 d-flex align-items-center justify-content-end">
            <div class="user-name text-end me-3">
                <h6 class="mb-0 text-gray-600">{{ Auth::user()->nama }}</h6>
                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->kode }}</p>
            </div>
            <div class="avatar">
                <img src="{{ Auth::user()->file }}" style="height: 50px; width: 50px">
            </div>
        </div>
    </div>

    @include('message')

    {{-- <form action="{{ route('admin.update_identitas') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') --}}
    <div class="card shadow-sm">
        <div class="card-header" style="padding-bottom: 0px">
            <h5>
                Import Data
            </h5>
            <hr>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.import_pustakawan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row align-items-end mt-3">
                    <div class="col-6">
                        <h6>Import Pustakawan</h6>
                        <div class="form-group mb-0 pb-0">
                            <input type="file" accept=".xlsx, .xls, .csv" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('admin.import_anggota') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row align-items-end mt-3">
                    <div class="col-6">
                        <h6>Import Anggota</h6>
                        <div class="form-group mb-0 pb-0">
                            <input type="file" accept=".xlsx, .xls, .csv" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('admin.import_buku') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row align-items-end mt-3">
                    <div class="col-6">
                        <h6>Import Buku</h6>
                        <div class="form-group mb-0 pb-0">
                            <input type="file" accept=".xlsx, .xls, .csv" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
