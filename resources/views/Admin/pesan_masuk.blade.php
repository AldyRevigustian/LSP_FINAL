@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-1">
                    <h3>Pesan Masuk</h3>
                </div>
            </div>
            @include('message')

        </div>
        <section class="section mt-3">
            <div class="card shadow-sm">
                <div class="card-header" style="padding-bottom: 0px">
                    <h5>
                        List Pesan Masuk
                    </h5>
                    <hr>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pengirim</th>
                                <th>Judul Pesan</th>
                                <th>Isi Pesan</th>
                                <th class="col-1">Status</th>
                                <th class="col-2">Tanggal Kirim</th>
                                <th class="col-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesans as $key => $pesan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pesan->pengirim->username }}</td>
                                    <td>{{ $pesan->judul }}</td>
                                    <td>{{ $pesan->isi }}</td>
                                    <td>{{ $pesan->status }}</td>
                                    <td>{{ $pesan->tanggal_kirim }}</td>
                                    <td>
                                        @if ($pesan->status == 'terkirim')
                                            <form action="{{ route('admin.baca_pesan') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $pesan->id }}" name="pesan_id">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-check2-all"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
