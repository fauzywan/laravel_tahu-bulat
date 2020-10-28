<?php

namespace App\Http\Controllers;

use App\Exceptions\Helpers\Toasterku;
use App\Pesanan;
use App\Transaksi_pesanan;
use Brian2694\Toastr\Facades\Toastr;
use Hamcrest\Type\IsObject;
use Illuminate\Http\Request;

class TransaksiPesananController extends Controller
{
    public function bayar(Pesanan $pesanan, Request $request)
    {

        $uang = implode('', explode(',', $request->uang));
        if (!is_object($request->pesanan)) {

            Transaksi_pesanan::create(['pesanan_id' => $request->pesanan, 'tanggal' => $request->tanggal, 'nominal_uang' => $uang]);
        } else {
            Transaksi_pesanan::create(['pesanan_id' => $pesanan->id, 'tanggal' => $request->tanggal, 'nominal_uang' => $uang]);
        }

        if ($pesanan->transaksi_pesanan->sum('nominal_uang') == ($pesanan->total_harga())) {
            $pesanan->update(['status' => 0]);
        }
        return redirect()->back()->with(['pesan' => 'Transaksi Berhasil', 'alert' => 'success']);
    }



    public function multi_transaksi(Request $request)
    {
        if (!isset($request->pesanan)) {
            return redirect()->back();
        }
        for ($i = 0; $i < count($request->pesanan); $i++) {
            $uang = implode('', explode(',', $request->uang[$i]));
            $sudahDibayar = Transaksi_pesanan::where('pesanan_id', $request->pesanan[$i])->sum('nominal_uang') + $uang;
            Transaksi_pesanan::create([
                'pesanan_id' => $request->pesanan[$i],
                'nominal_uang' => $uang,
                'tanggal' => now()
            ]);
            $pesanan = Pesanan::find($request->pesanan[$i]);
            if ($pesanan->transaksi_pesanan->sum('nominal_uang') == ($pesanan->total_harga())) {
                $pesanan->update(['keuangan' => 0]);
            }
        }
        return redirect()->back();
    }
    public function store_transaksi(Pesanan $pesanan)
    {
        return view('menu.pesanan.store_transaksi', compact('pesanan'));
    }

    public function store_transaksi_create(Pesanan $pesanan, Request $request)
    {

        $uang = implode('', explode(',', $request->uang));
        $create = Transaksi_pesanan::create(['pesanan_id' => $pesanan->id, 'nominal_uang' => $uang, 'tanggal' => $request->tanggal]);

        if (intval($pesanan->transaksi_pesanan->sum('nominal_uang')) == intval($pesanan->total_harga())) {
            $pesanan->update(['keuangan' => 0]);
        }
        if ($create == true) {
            Toastr::success('Transaksi Berhasil', '', Toasterku::config());
        } else {

            Toastr::success('Transaksi Gagal', '', Toasterku::config());
            return redirect()->back();
        }
        return redirect('/pesanan');
    }

    public function transaksi(Pesanan $pesanan, Request $request)
    {

        $uang = implode('', explode(',', $request->uang));
        $create = Transaksi_pesanan::create(['pesanan_id' => $pesanan->id, 'nominal_uang' => $uang, 'tanggal' => $request->tanggal]);

        if (intval($pesanan->transaksi_pesanan->sum('nominal_uang')) == intval($pesanan->harus_dibayar())) {
            $pesanan->update(['keuangan' => 0]);
        }
        if ($create == true) {
            Toastr::success('Transaksi Berhasil', '', Toasterku::config());
        } else {

            Toastr::success('Transaksi Gagal', '', Toasterku::config());
            return redirect()->back();
        }
        return redirect()->back();
    }
}
