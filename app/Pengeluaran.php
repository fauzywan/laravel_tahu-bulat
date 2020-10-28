<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
protected $table='pengeluaran';
protected $guarded=[];
public function suplier()
{
    return $this->belongsTo(Suplier::class);
}
}
