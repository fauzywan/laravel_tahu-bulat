<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = "peminjaman";
    protected $guarded = [];
    public function transaksi_peminjaman()
    {
        return $this->hasMany(transaksi_peminjaman::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
