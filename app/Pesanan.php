<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\False_;

class Pesanan extends Model
{
    /* Status*//*
     1.active Belum dibuat
     2.active Sedang dibuat
     */


    protected $table = "pesanan";
    protected $guarded = [];
    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
    public function buat_produk()
    {
        return $this->hasMany(Buat_produk::class);
    }

    public function harus_dibayar()
    {

        return $this->harga + $this->biaya_akomodasi;
    }
    public function belumDibayar()
    {
        if ($this->transaksi_pesanan->count() == null) {
            return $this->harga + $this->biaya_akomodasi - ($this->transaksi_pesanan->sum('nominal_uang'));
        } else {
            if ($this->harga + $this->biaya_akomodasi == $this->transaksi_pesanan->sum('nominal_uang')) {
                return 0;
            } else {

                return ($this->harga + $this->biaya_akomodasi) - $this->transaksi_pesanan->sum('nominal_uang');
            }
        }
    }
    public function transaksi_pesanan()
    {
        return $this->hasMany(Transaksi_pesanan::class);
    }

    public function sesi_produk()
    {
        return $this->hasMany(sesi_produk::class);
    }

    public function status()
    {
        if ($this->sesi_produk->count() != 0) {
            // return $this->sesi_produk;
            return true;
        };
        return false;
    }
    public function sesi()
    {
        if (isset($this->sesi_produk->where('pesanan_id', $this->id)->first()->sesi)) {

            return  $this->sesi_produk->where('pesanan_id', $this->id)->first()->sesi;
        }
        return false;
    }
    public function pemakaian()
    {
        // return view('p')
    }
    public function total_harga()
    {
        return $this->harga+$this->biaya_akomodasi+$this->potongan_harga;
    }
}
