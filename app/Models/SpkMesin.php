<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkMesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        // 'order_id',
        // 'mesin_id',
        // 'nama_order',
        'kirim',
        'ekspedisi'
    ];
    protected $table = 'spkmesin';
}
