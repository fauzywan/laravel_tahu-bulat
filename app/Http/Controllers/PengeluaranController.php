<?php

namespace App\Http\Controllers;

use App\Belanja;
use App\Suplier;
use App\Pengeluaran;
use App\Biaya_produksi;
use App\Transaksi_belanja;
use Brian2694\Toastr\Facades\Toastr;
use App\Exceptions\Helpers\Toasterku;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
 
    public function index()
    {
        $suplier = Suplier::all();
        $barang = Biaya_produksi::where('jenis_biaya_produksi_id',2)->get();
        return view('menu.belanja.pengeluaran', compact('suplier','barang'));
    }
    public function histori()
    {
        $tanggal = Belanja::distinct('created_at')->where('kuantitas', 0)->orderBy('created_at', 'desc')->get('created_at');


        return view('menu.belanja.histori_pengeluaran',compact('tanggal'));
    }
    public function store(Request $request)
    {

        for ($i=0; $i <count($request->barang) ; $i++) {
            for ($i = 0; $i < count($request->barang); $i++) {
                $dibayar = implode('', explode(',', $request->dibayar[$i]));
                $harga = implode('', explode(',', $request->harga[$i]));
                $total = implode('', explode(',', $request->total[$i]));
                $status = 1;
                $hutang = 0;
                if ($dibayar < $total) {
                    $hutang = 1;
                }
                Belanja::create([
                    'suplier_id' => $request->suplier[0],
                    'biaya_produksi_id' => $request->barang[$i],
                    'hutang' => $hutang,
                    'nomor_faktur' => $request->faktur[0],
                    'harga' => $harga,
                    'harga_satuan' => 0,
                    'kuantitas' => 0,
                    'tersedia' => 0,
                    'status' => 0,
                    'created_at' =>  $request->tanggal,

                ]);
                $belanja = Belanja::where([
                    'biaya_produksi_id' => $request->barang[$i],
                    'nomor_faktur' =>
                    $request->faktur[0]
                ])->latest('id')->first('id')->id;
                Transaksi_belanja::create([
                    'tanggal' => $request->tanggal,
                    'nominal_uang' => $dibayar,
                    'belanja_id' => $belanja,
                    'jenis_transaksi_id' => 1,

                ]);
            }
            
            Toastr::success('Transaksi Berhasil', '', Toasterku::config());
            return redirect()->back();
}
}
}