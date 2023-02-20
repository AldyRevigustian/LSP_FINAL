<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $anggotas = User::where('role', 'user')->get();
        return view('admin.laporan', compact('anggotas'));
    }

    public function tgl_peminjaman(Request $request)
    {
        $identitas = Identitas::first();
        $peminjamans = Peminjaman::where('tanggal_peminjaman', $request->tanggal_peminjaman)->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.laporan_pdf', compact('peminjamans', 'identitas'));
        return $pdf->download('laporan-peminjaman-pdf.pdf');
    }

    public function tgl_pengembalian(Request $request)
    {
        $identitas = Identitas::first();
        $peminjamans = Peminjaman::where('tanggal_pengembalian', $request->tanggal_pengembalian)->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.laporan_pdf', compact('peminjamans', 'identitas'));
        return $pdf->download('laporan-peminjaman-pdf.pdf');
    }

    public function anggota(Request $request)
    {
        $identitas = Identitas::first();
        $peminjamans = Peminjaman::where('user_id', $request->user_id)->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.laporan_pdf', compact('peminjamans', 'identitas'));
        return $pdf->download('laporan-peminjaman-pdf.pdf');
    }
}