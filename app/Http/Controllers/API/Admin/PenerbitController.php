<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json([
            'data' => $authors
        ]);
    }

    public function store(Request $request)
    {
        $author = Author::create([
            'nama' => $request->nama,
            'verif' => $request->verif,
        ]);

        if ($author) {
            $format = sprintf("%03d", $author->id);
            $author->update([
                'kode' => 'PP' . '' . $format
            ]);

            return response()->json([
                'message' => 'Sukses Menambahkan Author',
                'data' => $author,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menambahkan Author',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if ($author) {
            $author->update([
                'nama' => $request->nama ?? $author->nama,
                'verif' => $request->verif ?? $author->verif,
            ]);

            return response()->json([
                'message' => 'Sukses Mengupdate Author',
                'data' => $author,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengupdate Author',
        ], 400);
    }

    public function destroy($id)
    {
        $author = Author::find($id);

        if ($author) {
            $author->delete();
            return response()->json([
                'message' => 'Sukses Mendelete Author',
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mendelete Author',
        ]);
    }
}
