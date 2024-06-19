<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'nama_order',
        'deadline',
        'lokasi'
    ];
    protected $table = 'orders';

    public function spk(){
        return $this->hasMany(SPK::class, 'order_id', 'order_id');
    }
}
