<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $anggotas = User::where('role', 'user')->get();
        $bukus = Buku::all();
        $peminjamans = Peminjaman::where('kondisi_buku_saat_dikembalikan', null)->get();
        $pengembalians = Peminjaman::where('kondisi_buku_saat_dikembalikan', '!=', null)->get();
        $identitas = Identitas::first();

        return view('admin.dashboard', compact(
            'anggotas',
            'bukus',
            'peminjamans',
            'pengembalians',
            'identitas',
        ));
    }
}
