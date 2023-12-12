<?php

namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Buku([
            'isbn' => $row['isbn'],
            'judul' => $row['judul'],
            'kategori' => $row['kategori'],
            'pengarang' => $row['pengarang'],
            'tahun_terbit' => $row['tahun_terbit'],
            'jumlah_awal' => $row['jumlah_awal'],
            'stock' => $row['jumlah_awal'],
            'foto' => $row['foto'],
        ]);
    }
}
