<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::where('tanggal_pengembalian', '!=', null)->where('kondisi_buku_saat_dikembalikan', '!=', null)->where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($pengembalians as $p) {
            $datas['id'] = $p->id;
            $datas['user'] = $p->user->fullname;
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
        $pengembalian = Peminjaman::find($request->peminjaman_id);

        if ($pengembalian) {
            if ($pengembalian->kondisi_buku_saat_dipinjam == 'rusak' && $request->kondisi_buku_saat_dikembalikan == 'baik') {
                return response()->json([
                    'message' => 'Gagal Mengembalikan Buku',
                ], 400);
            }

            $buku = Buku::find($pengembalian->buku_id);
            $pengembalian->update([
                'tanggal_pengembalian' => date('Y-m-d'),
                'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan,
            ]);


            if ($request->kondisi_buku_saat_dikembalikan == 'baik') {
                $buku->update([
                    'j_buku_baik' => $buku->j_buku_baik + 1
                ]);
                $pengembalian->update([
                    'denda' => 0
                ]);
            }

            if ($request->kondisi_buku_saat_dikembalikan == 'rusak') {
                $buku->update([
                    'j_buku_rusak' => $buku->j_buku_rusak + 1
                ]);
                if ($pengembalian->kondisi_buku_saat_dipinjam == 'rusak') {
                    $pengembalian->update([
                        'denda' => 0
                    ]);
                } else {
                    $pengembalian->update([
                        'denda' => 20000
                    ]);
                }
            }

            if ($request->kondisi_buku_saat_dikembalikan == 'hilang') {
                $pengembalian->update([
                    'denda' => 50000
                ]);
            }

            $datas['id'] = $pengembalian->id;
            $datas['user'] = $pengembalian->user->fullname;
            $datas['buku'] = $pengembalian->buku->judul;
            $datas['tanggal_peminjaman'] = $pengembalian->tanggal_peminjaman;
            $datas['tanggal_pengembalian'] = $pengembalian->tanggal_pengembalian;
            $datas['kondisi_buku_saat_dipinjam'] = $pengembalian->kondisi_buku_saat_dipinjam;
            $datas['kondisi_buku_saat_dikembalikan'] = $pengembalian->kondisi_buku_saat_dikembalikan;
            $datas['denda'] = $pengembalian->denda;
            $data = $datas;

            return response()->json([
                'message' => 'Sukses Mengembalikan Buku',
                'data' => $data,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengembalikan Buku',
        ], 400);
    }
}
