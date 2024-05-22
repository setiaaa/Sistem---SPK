<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        'nama_mesin',
        'cetak',
        'ukuran_bahan',
        'set',
        'keterangan',
        'jumlah_cetak',
        'hasil_cetak',
        'tempat_cetak',
        'acuan_cetak',
        'jumlah_order'
    ];
    protected $table = 'produksi';
}
