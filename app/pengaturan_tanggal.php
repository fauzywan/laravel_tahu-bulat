<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengaturan_tanggal extends Model
{
    protected $table='pengaturan_tanggal';
    protected $fillable=['mulai','tutup'];
}
