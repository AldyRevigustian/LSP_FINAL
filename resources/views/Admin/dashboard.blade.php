    @extends('layouts.app')

    @include('components.admin')

    @section('content')
        <div class="col mt-2">
            <div class="row mt-5 mb-3">
                <div class="col-2 d-flex align-items-center">
                    <h1>Dashboard</h1>
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

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
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
                </section>
            </div>
        </div>
        <center style="margin-top: 50px">
            <img src="{{ $identitas->foto }}" style="max-width: 320px; height: 280px;" alt="Logo">
            <h1>{{ $identitas->nama_app }}</h1>
        </center>
    @endsection
