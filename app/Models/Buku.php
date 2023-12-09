<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'judul',
        'kategori',
        'pengarang',
        'tahun_terbit',
        'jumlah_awal',
        'stock',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
