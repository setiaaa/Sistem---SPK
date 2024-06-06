<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPKNota extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        'nama_bahan',
        'tebal_bahan',
        'ukuran',
        'jumlah_cetak',
        'ukuran_jadi',
        'rangkap',
        'warna_rangkap',
        'cetak',
        'warna',
        'finishing',
        'numerator',
        'keterangan'
    ];
    protected $table = 'spknota';

}
