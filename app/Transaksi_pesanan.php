<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_pesanan extends Model
{
    protected $table = "transaksi_pesanan";
    protected $guarded = [];
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
