@extends('layouts.app')

@include('components.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mt-5 mb-3">
                <div class="col-2 d-flex align-items-center">
                    <h1>Pengembalian</h1>
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
                    <a href="#" class="btn icon btn-primary text-light" data-bs-toggle="modal"
                        data-bs-target="#add"><i class="bi bi-plus-lg"></i> Add</a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Peminjaman</th>
                                <th>Kode Anggota</th>
                                <th>Nama Anggota</th>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Kondisi Pengembalian</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengembalians as $key => $pengembalian)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pengembalian->kode_pinjam }}</td>
                                    <td>{{ $pengembalian->user->kode }}</td>
                                    <td>{{ $pengembalian->user->nama }}</td>
                                    <td>{{ $pengembalian->buku->isbn }}</td>
                                    <td>{{ $pengembalian->buku->judul }}</td>
                                    <td>{{ $pengembalian->tanggal_peminjaman }}</td>
                                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                                    <td>
                                        @if ($pengembalian->kondisi_buku == 'baik')
                                            <span class="badge rounded-pill text-bg-success"
                                                style="min-width: 120px">{{ strtoupper($pengembalian->kondisi_buku) }}
                                            </span>
                                        @elseif ($pengembalian->kondisi_buku == 'hilang')
                                            <span class="badge rounded-pill text-bg-danger"
                                                style="min-width: 120px">{{ strtoupper($pengembalian->kondisi_buku) }}
                                            </span>
                                        @elseif ($pengembalian->kondisi_buku == 'rusak')
                                            <span class="badge rounded-pill text-bg-warning"
                                                style="min-width: 120px">{{ strtoupper($pengembalian->kondisi_buku) }}
                                            </span>
                                        @elseif ($pengembalian->kondisi_buku == 'telat')
                                            <span class="badge rounded-pill text-bg-secondary"
                                                style="min-width: 120px">{{ strtoupper($pengembalian->kondisi_buku) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $pengembalian->denda }}</td>
                                    <td>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.destroy_pengembalian', $pengembalian->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn icon btn-danger"><i
                                                    class="bi bi-trash-fill"></i></a>
                                        </form>
                                    </td>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Pengembalian</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store_pengembalian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="">Pilih Peminjaman</label>
                        <select class="form-select choices" name="peminjaman_id" id="peminjaman_id" required>
                            <option value="" selected disabled>--Select--</option>
                            @foreach ($peminjamans as $peminjaman)
                                <option value="{{ $peminjaman->id }}">{{ $peminjaman->kode_pinjam }} |
                                    {{ $peminjaman->user->nama }}</option>
                            @endforeach
                        </select>

                        <label for="">Kondisi Pengembalian</label>
                        <select class="form-select" name="kondisi_buku" id="" required
                            onchange="myFunction(this.options[this.selectedIndex].value)">
                            <option value="" selected disabled>--Select--</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                            <option value="telat">Telat</option>
                        </select>

                        <label for="" class="mt-3">Denda</label>
                        <div class="form-group">
                            <input type="number" placeholder="Denda" name="denda" class="form-control" id="denda"
                                required readonly>
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

    <script>
        let elDenda = document.getElementById('denda');
        var e = document.getElementById("peminjaman_id");


        function myFunction(chosen) {
            let valueId = e.options[e.selectedIndex].value;

            var data = {
                peminjaman_id: valueId,
                kondisi: chosen
            };

            var queryString = Object.keys(data)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(data[key]))
                .join('&');

            var apiUrl = '/transaksi/pengembalian/get-denda?' + queryString;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => elDenda.value = data.denda)
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
