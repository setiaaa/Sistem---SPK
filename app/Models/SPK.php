<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPK extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        'order_id',
        'status',
        'tanggal',
        'deadline_produksi',
        'lokasi_produksi'
    ];
    protected $table = 'spk';
}
