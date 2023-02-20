<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function peminjaman(Request $request)
    {
        $peminjamans = Peminjaman::whereDate('tanggal_peminjaman', $request->tanggal)->get();
        $data = [];
        foreach ($peminjamans as $peminjaman) {
            $datas['id'] = $peminjaman->id;
            $datas['user'] = $peminjaman->user->username;
            $datas['buku'] = $peminjaman->buku->judul;
            $datas['tanggal_peminjaman'] = $peminjaman->tanggal_peminjaman;
            $datas['tanggal_pengembalian'] = $peminjaman->tanggal_pengembalian;
            $datas['kondisi_buku_saat_dipinjam'] = $peminjaman->kondisi_buku_saat_dipinjam;
            $datas['kondisi_buku_saat_dikembalikan'] = $peminjaman->kondisi_buku_saat_dikembalikan;
            $datas['denda'] = $peminjaman->denda;
            $data[] = $datas;
        }
        return response()->json([
            'message' => 'Laporan Peminjaman ' . $request->tanggal,
            'data' => $data,
        ]);
    }

    public function pengembalian(Request $request)
    {
        $pengembalians = Peminjaman::whereDate('tanggal_pengembalian', $request->tanggal)->get();
        $data = [];
        foreach ($pengembalians as $pengembalian) {
            $datas['id'] = $pengembalian->id;
            $datas['user'] = $pengembalian->user->username;
            $datas['buku'] = $pengembalian->buku->judul;
            $datas['tanggal_peminjaman'] = $pengembalian->tanggal_peminjaman;
            $datas['tanggal_pengembalian'] = $pengembalian->tanggal_pengembalian;
            $datas['kondisi_buku_saat_dipinjam'] = $pengembalian->kondisi_buku_saat_dipinjam;
            $datas['kondisi_buku_saat_dikembalikan'] = $pengembalian->kondisi_buku_saat_dikembalikan;
            $datas['denda'] = $pengembalian->denda;
            $data[] = $datas;
        }
        return response()->json([
            'message' => 'Laporan Pengembalian ' . $request->tanggal,
            'data' => $data,
        ]);
    }

    public function anggota(Request $request)
    {
        $laporan = Peminjaman::where('user_id', $request->user_id)->get();
        $data = [];

        foreach ($laporan as $p) {
            $datas['id'] = $p->id;
            $datas['user'] = $p->user->username;
            $datas['buku'] = $p->buku->judul;
            $datas['tanggal_peminjaman'] = $p->tanggal_peminjaman;
            $datas['tanggal_pengembalian'] = $p->tanggal_pengembalian;
            $datas['kondisi_buku_saat_dipinjam'] = $p->kondisi_buku_saat_dipinjam;
            $datas['kondisi_buku_saat_dikembalikan'] = $p->kondisi_buku_saat_dikembalikan;
            $datas['denda'] = $p->denda;
            $data[] = $datas;
        }

        return response()->json([
            'message' => 'Laporan Anggota ' . User::where('id', $request->user_id)->first()->username,
            'data' => $data,
        ]);
    }
}