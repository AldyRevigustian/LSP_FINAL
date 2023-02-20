@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Kategori</h3>
                </div>
            </div>
            @include('message')

        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Tanggal
                                Peminjaman</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Tanggal
                                Pengembalian</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">Nama Anggota
                                (Siswa)</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h5>Tanggal Peminjaman</h5>
                            <form action="{{ route('admin.laporan_tglpeminjaman') }}" method="POST">
                                @csrf
                                <input type="date" name="tanggal_peminjaman" id="" class="form-control">
                                <br>
                                <button type="submit" class="btn btn-primary col-12">Print</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h5>Tanggal Pengembalian</h5>
                            <form action="{{ route('admin.laporan_tglpengembalian') }}" method="POST">
                                @csrf
                                <input type="date" name="tanggal_pengembalian" id="" class="form-control">
                                <br>
                                <button type="submit" class="btn btn-primary col-12">Print</button>
                            </form>
                        </div>
                        <div class="tab-pane fade select-anggota" id="contact" role="tabpanel"
                            aria-labelledby="contact-tab">
                            <h5>Nama Anggota (Siswa)</h5>
                            <form action="{{ route('admin.laporan_anggota') }}" method="POST">
                                @csrf
                                <select class="choices form-select" name="user_id" required>
                                    <option value=""selected disabled>Select Member</option>
                                    @foreach ($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}">{{ $anggota->nis }} | {{ $anggota->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary col-12">Print</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
