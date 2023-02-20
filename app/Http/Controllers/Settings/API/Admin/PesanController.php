<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function index()
    {
        $pesan_terkirim = Pesan::where('pengirim_id', Auth::user()->id)->get();
        $kirim = [];
        foreach ($pesan_terkirim as $k) {
            $kirims['id'] = $k->id;
            $kirims['penerima'] = $k->penerima->username;
            $kirims['pengirim'] = $k->pengirim->username;
            $kirims['judul'] = $k->judul;
            $kirims['isi'] = $k->isi;
            $kirims['status'] = $k->status;
            $kirims['tanggal_kirim'] = $k->tanggal_kirim;
            $kirim[] = $kirims;
        }

        $pesan_masuk = Pesan::where('penerima_id', Auth::user()->id)->get();
        $terima = [];
        foreach ($pesan_masuk as $p) {
            $terimas['id'] = $p->id;
            $terimas['penerima'] = $p->penerima->username;
            $terimas['pengirim'] = $p->pengirim->username;
            $terimas['judul'] = $p->judul;
            $terimas['isi'] = $p->isi;
            $terimas['status'] = $p->status;
            $terimas['tanggal_kirim'] = $p->tanggal_kirim;
            $terima[] = $terimas;
        }

        return response()->json([
            'data' => [
                'terkirim' => $kirim,
                'masuk' => $terima
            ]
        ]);
    }

    public function store(Request $request)
    {
        $pesan = Pesan::create([
            'penerima_id' => $request->penerima_id,
            'pengirim_id' => Auth::user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal_kirim' => date('Y-m-d H:i:s'),
        ]);
        if ($pesan) {
            return response()->json([
                'message' => 'Berhasil Mengirim Pesan',
                'data' => $pesan,
            ]);
        }
        return response()->json([
            'message' => 'Gagal Mengirim pesan'
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $pesan = Pesan::where('id', $id)->where('penerima_id', Auth::user()->id)->first();
        if ($pesan) {
            $pesan->update([
                'status' => 'terbaca'
            ]);
            return response()->json([
                'message' => 'Berhasil membaca pesan'
            ]);
        }
        return response()->json([
            'message' => 'Gagal membaca pesan'
        ], 400);
    }
}