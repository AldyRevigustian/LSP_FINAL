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
            'isbn' => '9786025781018',
            'judul' => 'Sejarah Terlengkap Peradaban Dunia',
            'kategori' => 'Sejarah',
            'pengarang' => 'Rizem Aizid',
            'tahun_terbit' => 'April - 2018',
            'jumlah_awal' => 10,
            'stock' => 9,
            'foto' => 'https://cdn.gramedia.com/uploads/items/9786025781018_Sejarah-Terlengkap-Peradaban-Dunia.jpg'
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
