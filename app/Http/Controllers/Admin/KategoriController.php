<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $kategori = Kategori::create([
            'nama' => $request->nama
        ]);

        if ($kategori) {
            $format = sprintf("%03d", $kategori->id);
            $kategori->update([
                'kode' => 'KK' . '' . $format
            ]);
            return redirect()->route('admin.kategori')->with('status', 'success')->with('message', 'Success Menambahkan Kategori Baru');
        }
        return redirect()->route('admin.kategori')->with('status', 'danger')->with('message', 'Gagal Menambahkan Kategori Baru');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->update([
            'nama' => $request->nama ?? $kategori->nama
        ]);

        if ($kategori) {
            return redirect()->route('admin.kategori')->with('status', 'success')->with('message', 'Success Mengedit Kategori');
        }
        return redirect()->route('admin.kategori')->with('status', 'danger')->with('message', 'Gagal Mengedit Kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id)->delete();

        if ($kategori) {
            return redirect()->route('admin.kategori')->with('status', 'success')->with('message', 'Success Menghapus Kategori');
        }
        return redirect()->route('admin.kategori')->with('status', 'danger')->with('message', 'Gagal Menghapus Kategori');
    }
}