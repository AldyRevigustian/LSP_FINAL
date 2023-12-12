<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Peminjaman;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('tanggal_pengembalian',  null)->get();
        $pengembalians = Peminjaman::where('tanggal_pengembalian', '!=', null)->get();
        $bukus = Buku::all();
        $anggotas = User::where('role', 'user')->get();
        return view('admin.pengembalian', compact('peminjamans', 'anggotas', 'bukus', 'pengembalians'));
    }

    public function store(Request $request)
    {
        $pengembalian = Peminjaman::find($request->peminjaman_id);
        $pengembalian->update([
            'tanggal_pengembalian' =>  date('Y-m-d'),
            'kondisi_buku' => $request->kondisi_buku,
            'denda' => $request->denda
        ]);

        if ($pengembalian) {
            if ($request->kondisi_buku != 'hilang') {
                $pengembalian->buku->update([
                    'stock' => $pengembalian->buku->stock + 1
                ]);
            }

            return redirect()->route('admin.pengembalian')->with('status', 'success')->with('message', 'Sukses Menambah pengembalian');
        }
        return redirect()->route('admin.pengembalian')->with('status', 'danger')->with('message', 'Gagal Menambah pengembalian');
    }

    public function destroy($id)
    {
        $pengembalian = Peminjaman::find($id)->update([
            'tanggal_pengembalian' => null,
            'kondisi_buku' => null,
            'denda' => null
        ]);


        if ($pengembalian) {
            Peminjaman::find($id)->buku->update([
                'stock' => Peminjaman::find($id)->buku->stock - 1
            ]);
            return redirect()->route('admin.pengembalian')->with('status', 'success')->with('message', 'Sukses Menghapus pengembalian');
        }
        return redirect()->route('admin.pengembalian')->with('status', 'danger')->with('message', 'Gagal Menghapus pengembalian');
    }

    public function get_denda(Request $request)
    {
        $denda = Identitas::first();
        if ($request->kondisi == 'baik') {
            return response()->json(['denda' => 0]);
        } else if ($request->kondisi == 'rusak') {
            return response()->json(['denda' => $denda->denda_rusak]);
        } else if ($request->kondisi == 'hilang') {
            return response()->json(['denda' => $denda->denda_hilang]);
        } else {
            $peminjaman = Peminjaman::find($request->peminjaman_id);

            $tanggal_sekarang = date('Y-m-d'); //11-12-2023
            $tanggal_peminjaman = new DateTime($peminjaman->tanggal_peminjaman); //02-12-2023
            $tanggal_sekarang = new DateTime($tanggal_sekarang);

            $selisih = date_diff($tanggal_peminjaman, $tanggal_sekarang);
            $selisih = $selisih->format('%a');

            $d = 0;

            if ($selisih > 7) {
                $d = ($selisih - 7) * $denda->denda_telat;
            }

            return response()->json(['denda' => $d]);
        }
    }
}
