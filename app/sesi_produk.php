<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sesi_produk extends Model
{
    protected $table = "sesi_produk";
    protected $guarded = [];
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function sesi()
    {
        return $this->belongsTo(sesi::class);
    }
    public function buat_produk()
    {
        return $this->hasMany(Buat_produk::class);
    }
}
