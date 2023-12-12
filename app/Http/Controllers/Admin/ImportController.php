<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AnggotaImport;
use App\Imports\BukuImport;
use App\Imports\PustakawanImport;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import');
    }

    public function importPustakawan(Request $request)
    {
        Excel::import(new PustakawanImport, $request->file);
        return redirect()->route('admin.import')->with('status', 'success')->with('message', 'Sukses Menambah Pustakawan');
    }

    public function importAnggota(Request $request)
    {
        Excel::import(new AnggotaImport, $request->file);
        return redirect()->route('admin.import')->with('status', 'success')->with('message', 'Sukses Menambah Anggota');
    }

    public function importBuku(Request $request)
    {
        Excel::import(new BukuImport, $request->file);
        return redirect()->route('admin.import')->with('status', 'success')->with('message', 'Sukses Menambah Buku');
    }
}
