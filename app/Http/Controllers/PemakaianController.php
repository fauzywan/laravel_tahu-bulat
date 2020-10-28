<?php

namespace App\Http\Controllers;

use App\Belanja;
use App\Biaya_produksi;
use App\Buat_produk;
use App\Pemakaian;
use App\Sisa_gudang;
use App\Sesi;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{

    public function store(Sesi $sesi, Request $request)
    {
        $explod = explode('_', $request->barang);

        Pemakaian::create([
            'sesi_id' => $sesi->id,
            'belanja_id' => $explod[0],
            'karyawan_id' => $request->karyawan,
            'jumlah' => $request->kuantitas,
            'tanggal' => $request->tanggal
        ]);

        Belanja::find(explode('_', $request->barang)[0])->update(['tersedia' => intval($explod[1]) - $request->kuantitas]);
        return redirect()->back();
    }
}
