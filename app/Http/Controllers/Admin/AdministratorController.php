<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.administrator', compact('admins'));
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
                'kode' => 'SA' . '' . $format
            ]);
            return redirect()->route('admin.administrator')->with('status', 'success')->with('message', 'Sukses Menambahkan Admin Baru');
        }
        return redirect()->route('admin.administrator')->with('status', 'danger')->with('message', 'Gagal Menambahkan Admin Baru');
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        $admin->update([
            'fullname' => $request->fullname ?? $admin->fullname,
            'username' => $request->username ?? $admin->username,
        ]);

        if ($admin) {
            return redirect()->route('admin.administrator')->with('status', 'success')->with('message', 'Sukses Mengedit Admin');
        }
        return redirect()->route('admin.administrator')->with('status', 'danger')->with('message', 'Gagal Mengedit Admin');
    }

    public function destroy($id)
    {
        $admin = User::find($id)->delete();

        if ($admin) {
            return redirect()->route('admin.administrator')->with('status', 'success')->with('message', 'Sukses Menghapus Admin');
        }
        return redirect()->route('admin.administrator')->with('status', 'danger')->with('message', 'Gagal Menghapus Admin');
    }
}
