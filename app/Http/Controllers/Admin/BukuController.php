<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Author;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('admin.buku', compact('bukus'));
    }

    public function store(Request $request)
    {
        $buku = Buku::create([
            'isbn' => $request->isbn,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_awal' => $request->jumlah,
            'stock' => $request->jumlah,
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
            'isbn' => $request->isbn ?? $buku->isbn,
            'judul' => $request->judul ?? $buku->judul,
            'kategori' => $request->kategori ?? $buku->kategori,
            'pengarang' => $request->pengarang ?? $buku->pengarang,
            'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
            'jumlah_awal' => $request->jumlah ?? $buku->jumlah,
            'stock' => $request->stock ?? $buku->stock,
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
