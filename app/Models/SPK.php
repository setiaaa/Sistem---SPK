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
        // 'nama_order',
        'status',
        'tanggal'
    ];
    protected $table = 'spk';
}
