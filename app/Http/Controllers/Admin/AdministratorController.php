<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'pustakawan')->get();
        return view('admin.administrator', compact('admins'));
    }

    public function store(Request $request)
    {
        $admin = User::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pustakawan',
        ]);

        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('img'), $imageName);

        $admin->update([
            'foto' => "/img/" . $imageName
        ]);


        if ($admin) {
            return redirect()->route('admin.administrator')->with('status', 'success')->with('message', 'Sukses Menambahkan Admin Baru');
        }
        return redirect()->route('admin.administrator')->with('status', 'danger')->with('message', 'Gagal Menambahkan Admin Baru');
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);

        if ($admin) {
            $admin->update([
                'kode' => $request->kode ?? $admin->kode,
                'nama' => $request->nama ?? $admin->nama,
                'email' => $request->email ?? $admin->email,
            ]);

            if ($request->password) {
                $admin->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            if ($request->foto) {
                $imageName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img'), $imageName);

                $admin->update([
                    'foto' => "/img/" . $imageName
                ]);
            }
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
