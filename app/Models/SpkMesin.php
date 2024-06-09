<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPKMesin extends Model
{

    use HasFactory;

    protected $fillable = [
        'spk_id',
        'kirim',
        'ekspedisi'
    ];
    protected $table = 'spkmesin';
    
    public function spk(){
        return $this->belongsTo(SPK::class, 'spk_id', 'spk_id');
    }

    public function produksi(){
        return $this->hasOne(Produksi::class, 'spk_id', 'spk_id');
    }

    public function finishing(){
        return $this->hasOne(Finishing::class, 'spk_id', 'spk_id');
    }

    public function bahan(){
        return $this->hasOne(Bahan::class, 'spk_id', 'spk_id');
    }
}
