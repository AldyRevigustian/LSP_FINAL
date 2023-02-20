<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function terkirim()
    {
        $pesans = Pesan::where('pengirim_id', Auth::user()->id)->orderBy('tanggal_kirim', 'desc')->get();
        $penerimas = User::where('role', 'user')->get();
        return view('admin.pesan_terkirim', compact('pesans', 'penerimas'));
    }

    public function masuk()
    {
        $pesans = Pesan::where('penerima_id', Auth::user()->id)->orderBy('tanggal_kirim', 'desc')->get();
        return view('admin.pesan_masuk', compact('pesans'));
    }

    public function baca_pesan(Request $request)
    {
        $pesan = Pesan::where('id', $request->pesan_id)->first();
        $pesan->update([
            'status' => 'terbaca'
        ]);
        return redirect()->route('admin.pesan_masuk')->with('status', 'success')->with('message', 'Success Membaca Pesan');
    }

    public function kirim_pesan(Request $request)
    {
        $pesan = Pesan::create([
            'pengirim_id' => Auth::user()->id,
            'penerima_id' => $request->penerima_id,
            'isi' => $request->isi,
            'judul' => $request->judul,
            'status' => 'terkirim',
            'tanggal_kirim' => date('Y-m-d H:i:s'),
        ]);

        if ($pesan) {
            return redirect()->route('admin.pesan_terkirim')->with('status', 'success')->with('message', 'Success Mengirim Pesan');
        }
    }
}
