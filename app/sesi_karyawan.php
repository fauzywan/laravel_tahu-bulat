<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sesi_karyawan extends Model
{
    //status=sesi_produk_id
    protected $table = "sesi_karyawan";
    protected $guarded = [];
    public function sesi()
    {
        return $this->belongsTo(sesi::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function buat_produk()
    {
        return $this->belongsTo(Buat_produk::class);
    }
 
}
