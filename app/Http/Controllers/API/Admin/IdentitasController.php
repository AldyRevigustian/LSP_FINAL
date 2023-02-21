<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = Identitas::first();
        return response()->json([
            'data' => $identitas
        ]);
    }

    public function update(Request $request)
    {
        $identitas = Identitas::first();
        if ($identitas) {
            $identitas->update([
                'nama_app' => $request->nama_app ?? $identitas->nama_app,
                'alamat_app' => $request->alamat_app ?? $identitas->alamat_app,
                'email_app' => $request->email_app ?? $identitas->email_app,
                'nomor_telepon' => $request->nomor_telepon ?? $identitas->nomor_telepon,
            ]);

            if ($request->foto != null) {
                $imageName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img'), $imageName);
                $identitas->update([
                    'foto' => "/img/" . $imageName
                ]);
            }
            return response()->json([
                'message' => 'Sukses Mengedit Identitas',
                'data' => $identitas
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengedit Identitas',
        ]);
    }
}
