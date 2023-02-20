<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $attrs = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        if (Auth::user()->verif  == 'unverified') {
            Auth::logout();
            return response([
                'message' => 'Akun anda belum terverifikasi silahkan hubungi administrator'
            ], 403);
        }

        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        $token = $user->createToken('Token Name')->plainTextToken;

        $user->update([
            'terakhir_login' => date('Y-m-d H:i:s')
        ]);
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'nis' => $request->nis,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'role' => 'user',
            'join_date' => date('Y-m-d H:i:s'),
            'terakhir_login' => date('Y-m-d H:i:s'),
        ]);

        if ($user) {
            $total = count(User::where('role', 'user')->get());
            $format = sprintf("%03d", $total + 1);
            $user->update([
                'kode' => 'AA' . '' . $format
            ]);


            return response()->json([
                'message' => 'Sukses Registrasi silahkan tunggu persetujuan administrator',
                'user' => $user,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Registrasi'
        ]);
    }
}