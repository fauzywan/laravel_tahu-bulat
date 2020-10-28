<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    protected $table = 'absen';
    protected $fillable = ['karyawan_id', 'tanggal'];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
