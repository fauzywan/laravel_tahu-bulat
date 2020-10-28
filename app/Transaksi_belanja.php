<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_belanja extends Model
{
    protected $table = "transaksi_belanja";
    protected $guarded = [];
    public function sisa()
    {
        return $this->belongsTo(Sisa_gudang::class);
    }
    public function belanja()
    {
        return $this->belongsTo(Belanja::class);
    }
}
