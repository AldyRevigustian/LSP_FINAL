<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::all();
        return view('admin.penerbit', compact('penerbits'));
    }

    public function store(Request $request)
    {
        $penerbit = Penerbit::create([
            'nama' => $request->nama,
            'verif' => $request->verif,
        ]);

        if ($penerbit) {
            $format = sprintf("%03d", $penerbit->id);
            $penerbit->update([
                'kode' => 'PP' . '' . $format
            ]);
            return redirect()->route('admin.penerbit')->with('status', 'success')->with('message', 'Success Menambahkan Penerbit Baru');
        }
        return redirect()->route('admin.penerbit')->with('status', 'danger')->with('message', 'Gagal Menambahkan Penerbit Baru');
    }

    public function update(Request $request, $id)
    {
        $penerbit = Penerbit::find($id);

        $penerbit->update([
            'nama' => $request->nama ?? $penerbit->nama,
            'verif' => $request->verif ?? $penerbit->verif,
        ]);

        if ($penerbit) {
            return redirect()->route('admin.penerbit')->with('status', 'success')->with('message', 'Success Mengedit Penerbit ');
        }
        return redirect()->route('admin.penerbit')->with('status', 'danger')->with('message', 'Gagal Mengedit Penerbit ');
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::find($id)->delete();

        if ($penerbit) {
            return redirect()->route('admin.penerbit')->with('status', 'success')->with('message', 'Success Menghapus Penerbit');
        }
        return redirect()->route('admin.penerbit')->with('status', 'danger')->with('message', 'Gagal Menghapus Penerbit');
    }
}
