<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adonan extends Model
{
    protected $table = "adonan";
    protected $guarded = [];
    public function biaya_produksi()
    {
        return $this->belongsTo(Biaya_produksi::class);
    }
    // public function gudang()
    // {
    //     return Gudang::where('biaya_produksi_id', $this->biaya_produksi_id)->first();
    // }
    public function adonan($biaya_produksi)
    {
        return Belanja::distinct('harga_satuan')->where(['biaya_produksi_id' => $biaya_produksi, 'status' => 1])->get(['harga_satuan', 'biaya_produksi_id']);
    }
    public function tersedia()
    {
        return Belanja::where(['status' => 1, 'biaya_produksi_id' => $this->biaya_produksi_id])->sum('tersedia');
    }
}
