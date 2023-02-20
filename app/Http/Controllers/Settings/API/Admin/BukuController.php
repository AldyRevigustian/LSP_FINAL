<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();

        $data = [];
        foreach ($bukus as $buku) {
            $datas['id'] = $buku->id;
            $datas['judul'] = $buku->judul;
            $datas['kategori_id'] = $buku->kategori->nama;
            $datas['penerbit_id'] = $buku->penerbit->nama;
            $datas['pengarang'] = $buku->pengarang;
            $datas['tahun_terbit'] = $buku->tahun_terbit;
            $datas['isbn'] = $buku->isbn;
            $datas['j_buku_baik'] = $buku->j_buku_baik;
            $datas['j_buku_rusak'] = $buku->j_buku_rusak;
            $data[] = $datas;
        }
        return response()->json([
            'data' => $data
        ]);
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

        if ($buku) {
            return response()->json([
                'message' => 'Berhasil Membuat Buku',
                'data' => $buku
            ]);
        }
        return response()->json([
            'message' => 'Gagal Membuat Buku',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);



        if ($buku) {
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
            return response()->json([
                'message' => 'Berhasil Mengedit Buku',
                'data' => $buku
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengedit Buku',
        ], 400);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);

        if ($buku) {
            $buku->delete();
            return response()->json([
                'message' => 'Berhasil Menghapus Buku',
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menghapus Buku',
        ], 400);
    }
}