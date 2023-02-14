<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';

    protected $fillable=[
        'user_id',
        'meja_id'
    ];

    public function meja(){
        return $this->belongsTo('App\Models\Meja');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function detail_pesanan(){
        return $this->hasMany('App\Models\DetailPesanan');
    }

    public function pembayaran(){
        return $this->hasOne('App\Models\Pembayaran');
    }
}
