<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return response()->json([
            'data' => $admins
        ]);
    }

    public function store(Request $request)
    {
        $admin = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => $request->password,
            'verif' => 'verified',
            'role' => 'admin',
            'foto' => '/assets/images/faces/2.jpg'
        ]);

        if ($admin) {
            $total = count(User::where('role', 'admin')->get());
            $format = sprintf("%03d", $total);
            $admin->update([
                'kode' => 'AA' . '' . $format
            ]);
            return response()->json([
                'message' => 'Berhasil Menambahkan Admin',
                'data' => $admin
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menambahkan Admin',
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('id', $id)->where('role', 'admin')->first();
        if ($admin) {
            $admin->update([
                'fullname' => $request->fullname ?? $admin->fullname,
                'username' => $request->username ?? $admin->username,
            ]);
            return response()->json([
                'message' => 'Berhasil Mengedit Admin',
                'data' => $admin
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengedit Admin',
        ], 400);
    }

    public function destroy($id)
    {
        $admin = User::where('id', $id)->where('role', 'admin')->first();

        if ($admin) {
            $admin->delete();
            return response()->json([
                'message' => 'Berhasil Menghapus Admin',
            ]);
        }
        return response()->json([
            'message' => 'Gagal Menghapus Admin',
        ], 400);
    }
}