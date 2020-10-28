<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    protected $table = "belanja";
    protected $guarded = [];
    protected $jenis;
    public function pengeluaranFilterCount($faktur,$jenis)
    {
        $this->jenis=$jenis;
        $a=$this->where('nomor_faktur', $faktur->nomor_faktur)->get();
$a=$a->filter(function($a){
return $a->biaya_produksi->jenis_biaya_produksi_id==$this->jenis;
});
return $a->count();
}
    public function gudangs()
    {
        return $this->belongsTo(Gudang::class);
    }
    public function biaya_produksi()
    {
        return $this->belongsTo(Biaya_produksi::class);
    }

    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class);
    }
    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
    public function transaksi_belanja()
    {
        return $this->hasMany(Transaksi_belanja::class);
    }
    public function hutang()
    {
        return $this->harga - $this->transaksi_belanja->sum('nominal_uang');
    }
    public function tersedia($harga, $biaya_produksi)
    {
        return Belanja::where(['harga_satuan' => $harga, 'biaya_produksi_id' => $biaya_produksi])->sum('tersedia');
    }
}
