<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sesi extends Model
{
    protected $table = "sesi";
    protected $guarded = [];
public function sedang_dibuat()
{
    return $this->buat_produk->where('status',1)->sum('balo')*740;
}
    public function sesi_produk()
    {
        return $this->hasMany(sesi_produk::class);
    }
    public function sesi_karyawan()
    {
        return $this->hasMany(sesi_karyawan::class);
    }
    public function buat_produk()
    {
        return $this->hasMany(Buat_produk::class);
    }

    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class);
    }
    public function total_harga()
    {
        $return = 0;
        foreach ($this->sesi_produk as $sesi) {
            $return += $sesi->pesanan->harga;
        }
        return number_format($return);
    }
    protected $belum_dikemas;
    protected $diterima=0;
    public function belum_dikemas()
    {
        $this->sesi_produk->map(function($produk){
                $this->belum_dikemas+=($produk->pesanan->jumlah-$produk->pesanan->diterima);
        });
        return ($this->belum_dikemas);
    }
    function jumlah_balo()
    {
        return $this->buat_produk->sum('balo');
    }
    function rata_rata()
    {
        return round($this->jumlah/$this->jumlah_balo());
    }
    function harga_balo()
    {
        return round($this->jumlah_balo()*100000);
    }
    function laba()
    {
        return round($this->harga-$this->harga_balo());
    }
}
