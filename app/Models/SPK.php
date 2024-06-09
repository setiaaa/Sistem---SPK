<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\SPKMesin;
use App\Models\SPKNota;

class SPK extends Model
{
    use HasFactory;

    protected $fillable = [
        'spk_id',
        'order_id',
        'user_id',
        'status',
        'tanggal',
        'deadline_produksi',
        'lokasi_produksi'
    ];
    protected $table = 'spk';

    public function spkMesin(){
        return $this->hasOne(SPKMesin::class, 'spk_id', 'spk_id');
    }
    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
    public function spkNota(){
        return $this->hasOne(SPKNota::class, 'spk_id', 'spk_id');
    }
}
