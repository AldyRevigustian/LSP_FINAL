<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('tanggal_pengembalian', null)->where('kondisi_buku_saat_dikembalikan', null)->where('user_id', Auth::user()->id)->get();
        $pengembalians = Peminjaman::where('tanggal_pengembalian', '!=', null)->where('kondisi_buku_saat_dikembalikan', '!=', null)->where('user_id', Auth::user()->id)->get();

        return view('user.pengembalian', compact('pengembalians', 'peminjamans'));
    }

    public function store(Request $request)
    {
        $pengembalian = Peminjaman::where('id', $request->peminjaman_id)->first();

        if ($pengembalian) {
            if ($pengembalian->kondisi_buku_saat_dipinjam == 'rusak' && $request->kondisi_buku_saat_dikembalikan == 'baik') {
                return redirect()->route('user.pengembalian')->with('status', 'danger')->with('message', 'Gagal menambah pengembalian');
            }

            $pengembalian->update([
                'tanggal_pengembalian' => date('Y-m-d'),
                'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan,
            ]);

            $buku = Buku::find($pengembalian->buku_id);

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


            return redirect()->route('user.pengembalian')->with('status', 'success')->with('message', 'Sukses menambah pengembalian');
        }
        return redirect()->route('user.pengembalian')->with('status', 'danger')->with('message', 'Gagal menambah pengembalian');
    }
}
