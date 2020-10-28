<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $table = "posisi";
    protected $guarded = [];
    
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}
