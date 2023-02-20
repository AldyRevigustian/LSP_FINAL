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

        if ($identitas) {
            return redirect()->route('admin.identitas')->with('status', 'success')->with('message', 'Berhasil Mengedit Identitas');
        }
        return redirect()->route('admin.identitas')->with('status', 'danger')->with('message', 'Gagal Mengedit Identitas');
    }
}