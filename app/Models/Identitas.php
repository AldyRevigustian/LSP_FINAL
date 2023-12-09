<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_app',
        'foto',
        'denda_rusak',
        'denda_telat',
        'denda_hilang',
        'max_pinjam'
    ];
}
