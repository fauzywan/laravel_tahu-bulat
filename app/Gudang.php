<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $guarded = [];
    public function biaya_produksi()
    {
        return $this->belongsTo(Biaya_produksi::class);
    }
    public function sisa_gudang()
    {
        return $this->hasMany(Sisa_gudang::class);
    }

    public function harga_satuan($id = "")
    {
        return (Sisa_gudang::where(['gudang_id' => $id, 'status' => 1])->orderBy('belanja_id', 'desc')->first('harga_satuan')->harga_satuan);
    }
    public function gudang()
    {
        return $this->hasMany(Belanja::class);
    }
    public function belanja()
    {
        return $this->hasMany(Belanja::class);
    }
    public function total_harga()
    {
        return Belanja::whereRaw("tersedia != 0 && gudang_id = $this->id")->sum('harga');
        // $this->belanja->where('tersedia > 0 ')->sum('harga');
    }
    public function tersedia($id = "")
    {
        return $this->belanja->where('status', 1)->sum('tersedia');
    }
    public function sedia($id = "")
    {
        return $this->belanja->where('status', 1)->sum('tersedia');
    }
}
