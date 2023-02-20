<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        @if ($identitas->nama_app == null)
            <img src="{{ public_path('assets/images/logo/logo.png') }}" width="100px" height="100px" alt="">
        @else
            <img src="{{ public_path($identitas->foto) }}" width="100px" height="100px" alt="">
        @endif

        <p style="padding-bottom: 0px; margin-bottom: 5px; size: 50px; font-weight: bold">Laporan Perpustakaan
            {{ $identitas->nama_app }}</p>
        <p style="font-size: 10px">
            {{ $identitas->alamat_app }}<br>Email : {{ $identitas->email_app }} | No Telepon :
            {{ $identitas->nomor_telepon }}</p>
    </center>
    <hr>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamans as $key => $peminjaman)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $peminjaman->user->fullname }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
