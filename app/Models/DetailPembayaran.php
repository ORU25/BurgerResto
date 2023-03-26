<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    use HasFactory;
    protected $table = 'detail_pembayaran';

    protected $fillable = [
        'pembayaran_id',
        'tunai',
        'kembalian',
    ];

    public function pembayaran(){
        return $this->belongsTo('App\Models\Pembayaran');
    }
}
