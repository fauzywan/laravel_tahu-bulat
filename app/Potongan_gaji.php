<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potongan_gaji extends Model
{
    protected $table = 'potongan_gaji';
    protected $guarded=[];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
