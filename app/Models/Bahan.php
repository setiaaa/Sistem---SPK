<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        'nama_bahan',
        'ukuran_plano',
        'jumlah_bahan',
        'ukuran_potong',
        'satu_plano'
    ];

    protected $table = 'bahan';
}
