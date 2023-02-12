<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';

    protected $fillable=[
        'nomor_meja',
        'status'
    ];

    public function pesanan(){
        return $this->hasOne('App\Models\Pesanan');
    }
}
