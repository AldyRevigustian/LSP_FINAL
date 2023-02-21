<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function peminjaman(Request $request)
    {
        $identitas = Identitas::first();
        $peminjamans = Peminjaman::where('tanggal_peminjaman', $request->tanggal)->get();

        $pdfName = 'Laporan_Peminjaman_' . $request->tanggal . '_' . time() . '.pdf';

        $pdf = app('dompdf.wrapper');
        $hasil = $pdf->loadView('admin.laporan_pdf', compact('peminjamans', 'identitas'));

        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/' . $pdfName, $content);

        return response()->json([
            'message' => 'Laporan Peminjaman ' . $request->tanggal,
            'pdf' => url('storage/' . $pdfName),
        ]);
    }

    public function pengembalian(Request $request)
    {
        $peminjamans = Peminjaman::whereDate('tanggal_pengembalian', $request->tanggal)->get();
        $identitas = Identitas::first();

        $pdfName = 'Laporan_Pengembalian_' . $request->tanggal . '_' . time() . '.pdf';
        $pdf = app('dompdf.wrapper');
        $hasil = $pdf->loadView('admin.laporan_pdf', compact('peminjamans', 'identitas'));

        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/' . $pdfName, $content);

        return response()->json([
            'message' => 'Laporan Pengembalian ' . $request->tanggal,
            'pdf' => url('storage/' . $pdfName),
        ]);
    }

    public function anggota(Request $request)
    {
        $peminjamans = Peminjaman::where('user_id', $request->user_id)->get();
        $identitas = Identitas::first();

        $pdfName = 'Laporan_Anggota' . $request->tanggal . '_' . time() . '.pdf';
        $pdf = app('dompdf.wrapper');
        $hasil = $pdf->loadView('admin.laporan_pdf', compact('peminjamans', 'identitas'));

        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/' . $pdfName, $content);

        $user = User::where('id', $request->user_id)->first();

        return response()->json([
            'message' => 'Laporan Anggota ' . $user->fullname,
            'pdf' => url('storage/' . $pdfName),
        ]);
    }
}
