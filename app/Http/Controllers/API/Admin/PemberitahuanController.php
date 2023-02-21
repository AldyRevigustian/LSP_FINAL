<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    public function index()
    {
        $pemberitahuans = Pemberitahuan::all();
        return response()->json([
            'data' => $pemberitahuans
        ]);
    }

    public function store(Request $request)
    {
        $pemberitahuan = Pemberitahuan::create([
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        if ($pemberitahuan) {
            return response()->json([
                'mesaage' => 'Sukses menambah pemberitahuan',
                'data' => $pemberitahuan
            ]);
        }
        return response()->json([
            'mesaage' => 'Gagal menambah pemberitahuan',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $pemberitahuan = Pemberitahuan::find($id);
        if ($pemberitahuan) {
            $pemberitahuan->update([
                'isi' => $request->isi ?? $pemberitahuan->isi,
                'status' => $request->status ?? $pemberitahuan->status,
            ]);
            return response()->json([
                'mesaage' => 'Sukses mengedit pemberitahuan',
                'data' => $pemberitahuan
            ]);
        }
        return response()->json([
            'mesaage' => 'Gagal mengedit pemberitahuan',
        ], 400);
    }

    public function destroy($id)
    {
        $pemberitahuan = Pemberitahuan::find($id);

        if ($pemberitahuan) {
            $pemberitahuan->delete();
            return response()->json([
                'mesaage' => 'Sukses Menghapus pemberitahuan',
            ]);
        }
        return response()->json([
            'mesaage' => 'Gagal Menghapus pemberitahuan',
        ], 400);
    }
}
