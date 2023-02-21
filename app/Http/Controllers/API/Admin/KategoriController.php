<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return response()->json([
            'data' => $kategoris
        ]);
    }

    public function store(Request $request)
    {
        $kategori = Kategori::create([
            'nama' => $request->nama
        ]);

        if ($kategori) {
            $format = sprintf("%03d", $kategori->id);
            $kategori->update([
                'kode' => 'KK' . '' . $format
            ]);
            return response()->json([
                'message' => 'Sukses Menambah Kategori',
                'data' => $kategori
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menambah Kategori',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        if ($kategori) {
            $kategori->update([
                'nama' => $request->nama ?? $kategori->nama
            ]);

            return response()->json([
                'message' => 'Sukses Mengupdate Kategori',
                'data' => $kategori
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengupdate Kategori',
        ], 400);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori) {
            $kategori->delete();
            return response()->json([
                'message' => 'Sukses Menghapus Kategori',
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menghapus Kategori',
        ]);
    }
}
