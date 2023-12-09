<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = Identitas::first();
        return view('admin.identitas', compact('identitas'));
    }

    public function update(Request $request)
    {
        $identitas = Identitas::first();

        $identitas->update([
            'nama_app' => $request->nama_app ?? $identitas->nama_app,
            'denda_rusak' => $request->denda_rusak ?? $identitas->denda_rusak,
            'denda_telat' => $request->denda_telat ?? $identitas->denda_telat,
            'denda_hilang' => $request->denda_hilang ?? $identitas->denda_hilang,
            'max_pinjam' => $request->max_pinjam ?? $identitas->max_pinjam,
        ]);

        if ($request->foto != null) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img'), $imageName);
            $identitas->update([
                'foto' => "/img/" . $imageName
            ]);
        }

        if ($identitas) {
            return redirect()->route('admin.identitas')->with('status', 'success')->with('message', 'Sukses Mengedit Identitas');
        }
        return redirect()->route('admin.identitas')->with('status', 'danger')->with('message', 'Gagal Mengedit Identitas');
    }
}
