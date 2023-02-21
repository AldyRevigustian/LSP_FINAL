<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // $profile =
        return view('User.profile');
    }

    public function update(Request $request)
    {
        $profile = User::find(Auth::user()->id);

        if ($profile) {
            $profile->update([
                'fullname' => $request->fullname ?? $profile->fullname,
                'username' => $request->username ?? $profile->username,
                'nis' => $request->nis ?? $profile->nis,
                'alamat' => $request->alamat ?? $profile->alamat,
                'kelas' => $request->kelas ?? $profile->kelas,
            ]);

            if ($request->foto) {
                $imageName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('img'), $imageName);
                $profile->update([
                    'foto' => "/img/" . $imageName
                ]);
            }

            return redirect()->route('user.profile')->with('status', 'success')->with('message', 'Sukses Mengupdate Profile');
        }
        return redirect()->route('user.profile')->with('status', 'danger')->with('message', 'Gagal Mengupdate Profile');
    }
}
