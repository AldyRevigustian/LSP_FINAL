<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('tanggal_pengembalian', null)->get();
        $bukus = Buku::all();
        $anggotas = User::where('role', 'user')->get();
        return view('admin.peminjaman', compact('peminjamans', 'anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $max = Identitas::first()->max_pinjam;
        $buku = Buku::find($request->buku_id);
        $cek = Peminjaman::where('user_id', $request->user_id)->where('tanggal_pengembalian', null)->count();
        $cek2 = Peminjaman::where('buku_id', $request->buku_id)->where('user_id', $request->user_id)->where('tanggal_pengembalian', null)->count();

        if ($cek <= $max && $cek2 == 0) {
            if ($buku->stock > 0) {
                $peminjaman = Peminjaman::create([
                    'kode_pinjam' => 'P' . rand(1000, 9999),
                    'user_id' => $request->user_id,
                    'buku_id' => $request->buku_id,
                    'tanggal_peminjaman' => date('Y-m-d H:i:s')
                ]);

                if ($peminjaman) {
                    $buku->update([
                        'stock' => $buku->stock - 1
                    ]);
                    return redirect()->route('admin.peminjaman')->with('status', 'success')->with('message', 'Sukses Menambah peminjaman');
                }
            }
        }
        return redirect()->route('admin.peminjaman')->with('status', 'danger')->with('message', 'Gagal Menambah peminjaman');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman) {
            $buku = $peminjaman->buku;
            $buku->update([
                'stock' => $buku->stock + 1
            ]);
            $peminjaman->delete();
            return redirect()->route('admin.peminjaman')->with('status', 'success')->with('message', 'Sukses Menghapus peminjaman');
        }
        return redirect()->route('admin.peminjaman')->with('status', 'danger')->with('message', 'Gagal Menghapus peminjaman');
    }
}
