<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pesan;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'kode' => 'AD001',
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'foto' => '/assets/images/faces/1.jpg'
        ]);

        User::create([
            'kode' => 'PD001',
            'nama' => 'Pustakawan',
            'email' => 'pustakawan@gmail.com',
            'password' => Hash::make('pustakawan'),
            'role' => 'pustakawan',
            'foto' => '/assets/images/faces/2.jpg'
        ]);

        User::create([
            'kode' => 'US001',
            'nama' => 'Aldy',
            'role' => 'user',
            'foto' => '/assets/images/faces/3.jpg'
        ]);

        User::create([
            'kode' => 'US002',
            'nama' => 'Revi',
            'role' => 'user',
            'foto' => '/assets/images/faces/4.jpg'
        ]);

        User::create([
            'kode' => 'US003',
            'nama' => 'Gustian',
            'role' => 'user',
            'foto' => '/assets/images/faces/5.jpg'
        ]);

        Buku::create([
            'isbn' => '9786229143623',
            'judul' => '100 Hal yang harus ditanyakan sebelum menikah',
            'kategori' => 'Umum',
            'pengarang' => 'Susan Piver',
            'tahun_terbit' => 'September - 2007',
            'jumlah_awal' => 40,
            'stock' => 40,
            'foto' => 'https://dpk.kepriprov.go.id/resources/cover/2017-03-06_THE-HARD-QUESTIONS-100-HAL-YANG-HARUS-DITANYAKAN-SEBELUM-MENIKAH-PIVER-SUS_022254.jpg'
        ]);
        Buku::create([
            'isbn' => '9786024816315',
            'judul' => 'Wabah dan Pandemi',
            'kategori' => 'Sains',
            'pengarang' => 'Meera Senthilingam',
            'tahun_terbit' => 'Agustus - 2021',
            'jumlah_awal' => 20,
            'stock' => 20,
            'foto' => 'https://cdn.gramedia.com/uploads/items/9786024816315_Wabah_dan_Pandemi_spot_uv-1.jpg'
        ]);
        Buku::create([
            'isbn' => '9786029193671',
            'judul' => 'Sejarah Dunia Yang Disembunyikan',
            'kategori' => 'Sejarah',
            'pengarang' => 'Jonathan Black',
            'tahun_terbit' => 'Mei - 2015',
            'jumlah_awal' => 10,
            'stock' => 9,
            'foto' => 'data:image/jpeg;base64,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'
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'P' . rand(1000, 9999),
            'buku_id' => 1,
            'user_id' => 3,
            'tanggal_peminjaman' => '2023-01-01',
            'tanggal_pengembalian' => '2023-01-10',
            'kondisi_buku' => 'baik',
            'denda' => 0,
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'P' . rand(1000, 9999),
            'buku_id' => 2,
            'user_id' => 3,
            'tanggal_peminjaman' => '2023-01-08',
            'tanggal_pengembalian' => '2023-01-10',
            'kondisi_buku' => 'telat',
            'denda' => 10000,
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'P' . rand(1000, 9999),
            'buku_id' => 3,
            'user_id' => 3,
            'tanggal_peminjaman' => '2023-12-01',
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'P' . rand(1000, 9999),
            'buku_id' => 2,
            'user_id' => 4,
            'tanggal_peminjaman' => '2023-01-01',
            'tanggal_pengembalian' => '2023-01-10',
            'kondisi_buku' => 'rusak',
            'denda' => 15000,
        ]);

        Peminjaman::create([
            'kode_pinjam' => 'P' . rand(1000, 9999),
            'buku_id' => 3,
            'user_id' => 5,
            'tanggal_peminjaman' => '2023-01-01',
            'tanggal_pengembalian' => '2023-01-10',
            'kondisi_buku' => 'hilang',
            'denda' => 50000,
        ]);

        Identitas::create([
            'nama_app' => 'E-Perpus',
            'denda_rusak' => 15000,
            'denda_telat' => 5000,
            'denda_hilang' => 50000,
            'max_pinjam' => 3,
            'foto' => '/assets/images/logo/logo.png',
        ]);
    }
}
