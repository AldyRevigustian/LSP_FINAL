<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        $penerbits = Penerbit::all();
        $kategoris = Kategori::all();
        return view('admin.buku', compact('bukus', 'penerbits', 'kategoris'));
    }

    public function store(Request $request)
    {
        $buku = Buku::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'penerbit_id' => $request->penerbit_id,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'j_buku_baik' => $request->j_buku_baik,
            'j_buku_rusak' => $request->j_buku_rusak,
        ]);


        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('img'), $imageName);
        $buku->update([
            'foto' => "/img/" . $imageName
        ]);

        if ($buku) {
            return redirect()->route('admin.buku')->with('status', 'success')->with('message', 'Sukses Menambah buku');
        }
        return redirect()->route('admin.buku')->with('status', 'danger')->with('message', 'Gagal Menambah buku');
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul ?? $buku->judul,
            'kategori_id' => $request->kategori_id ?? $buku->kategori_id,
            'penerbit_id' => $request->penerbit_id ?? $buku->penerbit_id,
            'pengarang' => $request->pengarang ?? $buku->pengarang,
            'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
            'isbn' => $request->isbn ?? $buku->isbn,
            'j_buku_baik' => $request->j_buku_baik ?? $buku->j_buku_baik,
            'j_buku_rusak' => $request->j_buku_rusak ?? $buku->j_buku_rusak,
        ]);

        if ($request->foto) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img'), $imageName);
            $buku->update([
                'foto' => "/img/" . $imageName
            ]);
        }

        if ($buku) {
            return redirect()->route('admin.buku')->with('status', 'success')->with('message', 'Sukses Mengubah buku');
        }
        return redirect()->route('admin.buku')->with('status', 'danger')->with('message', 'Gagal Mengubah buku');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id)->delete();
        if ($buku) {
            return redirect()->route('admin.buku')->with('status', 'success')->with('message', 'Sukses Menghapus buku');
        }
        return redirect()->route('admin.buku')->with('status', 'danger')->with('message', 'Gagal Menghapus buku');
    }
}
