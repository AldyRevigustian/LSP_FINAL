<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::all();
        return response()->json([
            'data' => $beritas
        ]);
    }

    public function store(Request $request)
    {
        $berita = Berita::create([
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        if ($berita) {
            return response()->json([
                'mesaage' => 'Berhasil menambah berita',
                'data' => $berita
            ]);
        }
        return response()->json([
            'mesaage' => 'Gagal menambah berita',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        if ($berita) {
            $berita->update([
                'isi' => $request->isi ?? $berita->isi,
                'status' => $request->status ?? $berita->status,
            ]);
            return response()->json([
                'mesaage' => 'Berhasil mengedit berita',
                'data' => $berita
            ]);
        }
        return response()->json([
            'mesaage' => 'Gagal mengedit berita',
        ], 400);
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);

        if ($berita) {
            $berita->delete();
            return response()->json([
                'mesaage' => 'Berhasil Menghapus berita',
            ]);
        }
        return response()->json([
            'mesaage' => 'Gagal Menghapus berita',
        ], 400);
    }
}