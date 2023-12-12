<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = User::where('role', 'user')->get();
        return view('admin.anggota', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $anggota = User::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'role' => 'user',
        ]);

        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('img'), $imageName);

        $anggota->update([
            'foto' => "/img/" . $imageName
        ]);

        if ($anggota) {
            return redirect()->route('admin.anggota')->with('status', 'success')->with('message', 'Sukses Menambahkan Anggota');
        }

        return redirect()->route('admin.anggota')->with('status', 'danger')->with('message', 'Gagal Menambahkan Anggota');
    }

    public function update(Request $request, $id)
    {
        $anggota = User::find($id);

        if ($anggota) {
            $anggota->update([
                'kode' => $request->kode ?? $anggota->kode,
                'nama' => $request->nama ?? $anggota->nama,
            ]);

            if ($request->foto) {
                $imageName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img'), $imageName);

                $anggota->update([
                    'foto' => "/img/" . $imageName
                ]);
            }

            return redirect()->route('admin.anggota')->with('status', 'success')->with('message', 'Suskses Mengedit Anggota');
        }
        return redirect()->route('admin.anggota')->with('status', 'danger')->with('message', 'Gagal Mengedit Anggota');
    }

    public function destroy($id)
    {
        $anggota = User::find($id)->delete();

        if ($anggota) {
            return redirect()->route('admin.anggota')->with('status', 'success')->with('message', 'Suskses Menghapus Anggota');
        }
        return redirect()->route('admin.anggota')->with('status', 'danger')->with('message', 'Gagal Menghapus Anggota');
    }
}
