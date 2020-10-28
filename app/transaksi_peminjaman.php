<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_peminjaman extends Model
{
    protected $table = 'transaksi_peminjaman';
    protected $guarded = [];
    public function peminjaman()
    {
        return $this->belongsTo(peminjaman::class);
    }
}
