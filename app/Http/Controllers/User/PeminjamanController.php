<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', Auth::user()->id)->get();
        $bukus = Buku::all();
        return view('user.peminjaman', compact('peminjamans', 'bukus'));
    }

    public function store(Request $request)
    {
        $cek = Peminjaman::where('user_id', Auth::user()->id)->where('buku_id', $request->buku_id)->where('kondisi_buku_saat_dikembalikan', null)->first();
        if ($cek == null) {
            $buku = Buku::find($request->buku_id);
            if ($request->kondisi_buku_saat_dipinjam == 'baik') {
                if ($buku->j_buku_baik > 0) {
                    $peminjaman = Peminjaman::create([
                        'buku_id' => $request->buku_id,
                        'user_id' => Auth::user()->id,
                        'tanggal_peminjaman' => date('Y-m-d'),
                        'kondisi_buku_saat_dipinjam' => 'baik',
                    ]);
                    $buku->update([
                        'j_buku_baik' => $buku->j_buku_baik - 1
                    ]);
                } else {
                    return redirect()->route('user.peminjaman')->with('status', 'danger')->with('message', 'Stok Buku Habis');
                }
            } else if ($request->kondisi_buku_saat_dipinjam == 'rusak') {
                if ($buku->j_buku_rusak > 0) {
                    $peminjaman = Peminjaman::create([
                        'user_id' => Auth::user()->id,
                        'buku_id' => $request->buku_id,
                        'tanggal_peminjaman' => date('Y-m-d'),
                        'kondisi_buku_saat_dipinjam' => 'rusak',
                    ]);
                    $buku->update([
                        'j_buku_rusak' => $buku->j_buku_rusak - 1
                    ]);
                } else {
                    return redirect()->route('user.peminjaman')->with('status', 'danger')->with('message', 'Stok Buku Habis');
                }
            }

            return redirect()->route('user.peminjaman')->with('status', 'success')->with('message', 'Berhasil menambah peminjaman');
        };

        return redirect()->route('user.peminjaman')->with('status', 'danger')->with('message', 'Gagal menambah peminjaman');
    }
}
