<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = "distributor";
    protected $guarded = [];
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
