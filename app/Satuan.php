<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = "satuan";
    protected $guarded = [];
    public function produksi()
    {
    return $this->hasMany(Biaya_produksi::class);
    }
}
