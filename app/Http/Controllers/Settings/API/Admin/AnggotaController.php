<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();

        return response()->json([
            'message' => 'Data All Anggota',
            'data' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'nis' => $request->nis,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'join_date' => date('Y-m-d H:i:s'),
            'terakhir_login' => date('Y-m-d H:i:s'),
            'verif' => $request->verif
        ]);

        if ($user) {
            $format = sprintf("%03d", $user->id);
            $user->update([
                'kode' => 'AA' . '' . $format
            ]);

            return response()->json([
                'data' => $user,
                'message' => 'Sukses menambahkan anggota',
            ], 200);
        }

        return response()->json([
            'message' => 'Gagal menambahkan anggota',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->where('role', 'user')->first();
        if ($user) {
            $user->update([
                'nis' => $request->nis ?? $user->nis,
                'fullname' => $request->fullname ?? $user->fullname,
                'username' => $request->username ?? $user->username,
                'kelas' => $request->kelas ?? $user->kelas,
                'alamat' => $request->alamat ?? $user->alamat,
                'verif' => $request->verif ?? $user->verif,
            ]);
            return response()->json([
                'message' => 'Success update data anggota',
                'data' => $user,
            ]);
        }
        return response()->json([
            'message' => 'Gagal update anggota',
        ], 400);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->where('role', 'user')->first();
        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'Anggota berhasil di hapus'
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menghapus anggota',
        ], 400);
    }
}