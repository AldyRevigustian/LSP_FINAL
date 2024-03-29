<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::all();
        return response()->json([
            'data' => $penerbits
        ]);
    }

    public function store(Request $request)
    {
        $penerbit = Penerbit::create([
            'nama' => $request->nama,
            'verif' => $request->verif,
        ]);

        if ($penerbit) {
            $format = sprintf("%03d", $penerbit->id);
            $penerbit->update([
                'kode' => 'PP' . '' . $format
            ]);

            return response()->json([
                'message' => 'Sukses Menambahkan Penerbit',
                'data' => $penerbit,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menambahkan Penerbit',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $penerbit = Penerbit::find($id);
        if ($penerbit) {
            $penerbit->update([
                'nama' => $request->nama ?? $penerbit->nama,
                'verif' => $request->verif ?? $penerbit->verif,
            ]);

            return response()->json([
                'message' => 'Sukses Mengupdate Penerbit',
                'data' => $penerbit,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengupdate Penerbit',
        ], 400);
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::find($id);

        if ($penerbit) {
            $penerbit->delete();
            return response()->json([
                'message' => 'Sukses Mendelete Penerbit',
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mendelete Penerbit',
        ]);
    }
}
