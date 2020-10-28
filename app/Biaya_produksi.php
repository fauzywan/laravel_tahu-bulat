<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biaya_produksi extends Model
{
    protected $table = 'biaya_produksi';    //
    protected $guarded = [];
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function belanja()
    {
        return $this->hasMany(Belanja::class);
    }
    public function gudangs()
    {
        return $this->hasOne(Gudang::class);
    }
    public function total_harga()
    {
        return Belanja::whereRaw("tersedia != 0 && biaya_produksi_id = $this->id && status = 1")->sum('harga');
    }
    public function tersedia()
    {
        return Belanja::whereRaw("tersedia != 0 && biaya_produksi_id = $this->id && status = 1")->sum('tersedia');
    }
    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class);
    }
    public function adonan()
    {
        return $this->hasMany(Adonan::class);
    }
}
