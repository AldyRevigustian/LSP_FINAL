<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    public function index()
    {
        $pemberitahuans = Pemberitahuan::all();
        return view('admin.pemberitahuan', compact('pemberitahuans'));
    }

    public function store(Request $request)
    {
        $pemberitahuan = Pemberitahuan::create([
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        if ($pemberitahuan) {
            return redirect()->route('admin.pemberitahuan')->with('status', 'success')->with('message', 'Success Menambahkan Pemberitahuan Baru');
        }
        return redirect()->route('admin.pemberitahuan')->with('status', 'danger')->with('message', 'Gagal Menambahkan Pemberitahuan Baru');
    }

    public function update(Request $request, $id)
    {
        $pemberitahuan = Pemberitahuan::find($id);
        $pemberitahuan->update([
            'isi' => $request->isi ?? $pemberitahuan->isi,
            'status' => $request->status ?? $pemberitahuan->status,
        ]);

        if ($pemberitahuan) {
            return redirect()->route('admin.pemberitahuan')->with('status', 'success')->with('message', 'Success Mengedit Pemberitahuan');
        }
        return redirect()->route('admin.pemberitahuan')->with('status', 'danger')->with('message', 'Gagal Mengedit Pemberitahuan');
    }

    public function destroy($id)
    {
        $pemberitahuan = Pemberitahuan::find($id)->delete();

        if ($pemberitahuan) {
            return redirect()->route('admin.pemberitahuan')->with('status', 'success')->with('message', 'Success Menghapus Pemberitahuan');
        }
        return redirect()->route('admin.pemberitahuan')->with('status', 'danger')->with('message', 'Gagal Menghapus Pemberitahuan');
    }
}
