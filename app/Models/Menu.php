<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table= 'menu';

    protected $fillable= [
        'nama',
        'kategori_id',
        'gambar',
        'harga',
        'stok',
        'status'
    ];

    public function kategori(){
        return $this->belongsTo('App\Models\Kategori');;
    }

    public function detail_pesanan(){
        return $this->hasMany('App\Models\DetailPesanan');
    }
}
