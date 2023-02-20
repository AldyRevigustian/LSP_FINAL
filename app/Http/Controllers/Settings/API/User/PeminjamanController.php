<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', Auth::user()->id)->get();

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
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $buku = Buku::where('id', $request->buku_id)->first();
        $cek = Peminjaman::where('user_id', Auth::user()->id)->where('buku_id', $request->buku_id)->where('kondisi_buku_saat_dikembalikan', null)->get();
        if ($cek->isEmpty()) {
            $peminjaman = Peminjaman::create([
                'user_id' => Auth::user()->id,
                'buku_id' => $request->buku_id,
                'tanggal_peminjaman' => date('Y-m-d'),
                'kondisi_buku_saat_dipinjam' => $request->kondisi_buku_saat_dipinjam,
            ]);
            if ($peminjaman) {
                $data = [];
                $datas['id'] = $peminjaman->id;
                $datas['user'] = $peminjaman->user->username;
                $datas['buku'] = $peminjaman->buku->judul;
                $datas['tanggal_peminjaman'] = $peminjaman->tanggal_peminjaman;
                $datas['kondisi_buku_saat_dipinjam'] = $peminjaman->kondisi_buku_saat_dipinjam;
                $data[] = $datas;

                $pemberitahuan = Pemberitahuan::create([
                    'status' => 'peminjaman',
                    'isi' => Auth::user()->username . " | " . $peminjaman->buku->judul,
                ]);
                if ($request->kondisi_buku_saat_dipinjam == 'baik') {
                    $buku->update([
                        'j_buku_baik' => $buku->j_buku_baik - 1
                    ]);

                    return response()->json([
                        'message' => 'Berhasil Menambahkan Peminjaman',
                        'data' => $data
                    ]);
                } else {
                    $buku->update([
                        'j_buku_rusak' => $buku->j_buku_rusak - 1
                    ]);
                    return response()->json([
                        'message' => 'Berhasil Menambahkan Peminjaman',
                        'data' => $data
                    ]);
                }
            }
            return response()->json([
                'message' => 'Gagal Menambahkan Peminjaman',
            ], 400);
        }
        return response()->json([
            'message' => 'Gagal Menambahkan Peminjaman',
        ], 400);
    }
}