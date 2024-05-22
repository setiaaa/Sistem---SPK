<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        'finishing',
        'laminasi',
        'potong_jadi',
        'keterangan',
    ];
    protected $table = 'finishing';
}
