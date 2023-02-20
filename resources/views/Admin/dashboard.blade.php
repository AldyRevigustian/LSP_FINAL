    @extends('layouts.app')

    @include('components.admin')

    @section('content')
        <div class="col">

            <div class="page-heading">

                <h3>Dashboard</h3>
                <a class="btn btn-primary" href="{{ route('admin.pemberitahuan') }}">
                    <i class="bi bi-plus-lg"></i>Pemberitahuan
                </a>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-2 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">
                                                    Anggota
                                                </h6>
                                                <h6 class="font-extrabold mb-0">{{ count($anggotas) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-2 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="bi-book-fill"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Buku</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($bukus) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-2 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                                <div class="stats-icon green mb-2">
                                                    <i class="bi-arrow-right"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Peminjaman</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($peminjamans) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-2 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                                <div class="stats-icon red mb-2">
                                                    <i class="bi-arrow-left-right"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Pengembalian</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($pengembalians) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4-5 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ Auth::user()->foto }}" />
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">{{ Auth::user()->fullname }}</h5>
                                        <h6 class="text-muted mb-0">{{ Auth::user()->username }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <center style="margin-top: 100px">
            <img src="{{ $identitas->foto }}" style="width: 300px; height: 300px;" alt="">
            <h6 class="font-bold">Alamat : {{ $identitas->alamat_app }}<br>Email : {{ $identitas->email_app }} | Nomor
                Telepon
                :
                {{ $identitas->nomor_telepon }}</h6>
        </center>
    @endsection
