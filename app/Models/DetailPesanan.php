<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $table = 'dtail_pesanan';

    protected $fillable=[
        'pesanan_id',
        'menu_id',
        'jumlah',
        'status',
        'meja_id'
    ];

    public function pesanan(){
        return $this->belongsTo('App\Models\Pesanan');
    }

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }
}
