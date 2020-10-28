<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $table = 'suplier';
    protected $guarded = [];
    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }
    public function belanja()
    {
        return $this->hasMany(Belanja::class);
    }
    public function modalDiluar()
    {
        return $this;
    }
}
