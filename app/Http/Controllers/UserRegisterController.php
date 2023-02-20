<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'fullname' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'nis' => $request->nis,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'role' => 'user',
            'join_date' => date('Y-m-d H:i:s'),
            'foto' => '/assets/images/faces/1.jpg'
        ]);
        if ($user) {
            $format = sprintf("%03d", $user->id);
            $user->update([
                'kode' => 'AA' . '' . $format
            ]);

            return redirect()->route('login')->with('status', 'success')->with('message', 'Sukses registrasi silahkan tunggu admin memverifikasi');
        }
        return redirect()->route('login')->with('status', 'danger')->with('message', 'Gagal registrasi');
    }
}
