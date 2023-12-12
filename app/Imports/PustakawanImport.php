<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PustakawanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)

    {
        return new User([
            'kode' => $row['kode'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role' => "pustakawan",
            'foto' => $row['foto'],
        ]);
    }
}
