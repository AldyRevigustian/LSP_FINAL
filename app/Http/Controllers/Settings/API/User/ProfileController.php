<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $profile = User::find(Auth::user()->id);

        $profile->update([
            'nis' => $request->nis ?? $request->nis,
            'fullname' => $request->fullname ?? $request->fullname,
            'username' => $request->username ?? $request->username,
            'password' => $request->password ?? $request->password,
            'kelas' => $request->kelas ?? $request->kelas,
            'alamat' => $request->alamat ?? $request->alamat,
        ]);

        if ($request->foto != null) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img'), $imageName);
            User::find(Auth::user()->id)->update([
                'foto' => "/img/" . $imageName
            ]);
        }
        return response()->json([
            'message' => 'Sukses Mengupdate Profile',
            'data' => $profile
        ]);
    }
}