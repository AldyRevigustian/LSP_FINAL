<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function terkirim()
    {
        $pesans = Pesan::where('pengirim_id', Auth::user()->id)->get();
        $penerimas = User::where('role', 'admin')->get();
        return view('User.pesan_terkirim', compact('pesans', 'penerimas'));
    }

    public function kirim_pesan(Request $request)
    {
        $pesan = Pesan::create([
            'penerima_id' => $request->penerima_id,
            'pengirim_id' => Auth::user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'terkirim',
            'tanggal_kirim' => date('Y-m-d'),
        ]);

        if ($pesan) {
            return redirect()->route('user.pesan_terkirim')->with('status', 'success')->with('message', 'Sukses Mengirim Pesan');
        }
        return redirect()->route('user.pesan_terkirim')->with('status', 'danger')->with('message', 'Gagal Mengirim Pesan');
    }

    public function masuk()
    {
        $pesans = Pesan::where('penerima_id', Auth::user()->id)->get();

        return view('User.pesan_masuk', compact('pesans'));
    }

    public function baca_pesan(Request $request)
    {
        $pesan = Pesan::where('id', $request->pesan_id)->first();
        if ($pesan) {
            $pesan->update([
                'status' => 'terbaca'
            ]);
            return redirect()->route('user.pesan_masuk')->with('status', 'success')->with('message', 'Sukses Mengupdate Pesan');
        }
        return redirect()->route('user.pesan_masuk')->with('status', 'danger')->with('message', 'Gagal Mengupdate Pesan');
    }
}
