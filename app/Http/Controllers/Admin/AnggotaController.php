<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
            'nis' => $request->nis,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => $request->password,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'verif' => $request->verif,
            'role' => 'user',
            'foto' => '/assets/images/faces/1.jpg',
            'join_date' => date('Y-m-d'),
        ]);

        if ($anggota) {
            $format = sprintf("%03d", $anggota->id);
            $anggota->update([
                'kode' => 'AA' . '' . $format
            ]);

            return redirect()->route('admin.anggota')->with('status', 'success')->with('message', 'Sukses Menambahkan Anggota');
        }
        return redirect()->route('admin.anggota')->with('status', 'danger')->with('message', 'Gagal Menambahkan Anggota');
    }

    public function update(Request $request, $id)
    {
        $anggota = User::find($id);

        if ($anggota) {
            $anggota->update([
                'nis' => $request->nis ?? $anggota->nis,
                'fullname' => $request->fullname ?? $anggota->fullname,
                'username' => $request->username ?? $anggota->username,
                'kelas' => $request->kelas ?? $anggota->kelas,
                'verif' => $request->verif ?? $anggota->verif,
                'alamat' => $request->alamat ?? $anggota->alamat,
            ]);
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
