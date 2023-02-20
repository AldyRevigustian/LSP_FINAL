<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::all();
        $data = [];
        foreach ($peminjamans as $p) {
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
            'data' => $data
        ]);
    }
}