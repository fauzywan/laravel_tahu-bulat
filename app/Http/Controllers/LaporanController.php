<?php

namespace App\Http\Controllers;

use App\Belanja;
use App\Pesanan;
use App\Pemakaian;
use App\pengaturan_produk;
use App\pengaturan_tanggal;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan()
    {
        return view('menu.laporan.index');
    }

    public function index()
    {
        $pengaturan_tanggal = pengaturan_tanggal::latest()->first();
        $tanggal = date('Y-m-d');
        $jumlah         = pengaturan_produk::latest()->first()->jumlah;
         $belanja  = Belanja::where('created_at', '>=', $pengaturan_tanggal->mulai)->where('created_at', '<=', $pengaturan_tanggal->tutup)->get();
         $pesanan  = Pesanan::where('tanggal', '>=', $pengaturan_tanggal->mulai)->where('tanggal', '<=', $pengaturan_tanggal->tutup)->get();
        $total_harga    = 0;
        $uang_masuk     = 0;
        $belum_dibayar  = 0;

        for ($i = 0; $i < count($pesanan); $i++) {
            $total_harga += $pesanan[$i]->total_harga();
            $uang_masuk += $pesanan[$i]->total_harga() - $pesanan[$i]->belumDibayar();
            $belum_dibayar += $pesanan[$i]->belumDibayar();
        }
        $uang['masuk'] = $uang_masuk;
        $uang['total'] = $total_harga;
        $uang['diluar'] = $belum_dibayar;
        $uang['pemakaian'] = Pemakaian::where('tanggal', '>=', $pengaturan_tanggal->mulai)->where('tanggal', '<=', $pengaturan_tanggal->tutup)->sum('harga');
        $uang['baloan'] = round($pesanan->sum('jumlah') / $jumlah);
        if ($uang['baloan'] == 0) {

            $uang['rata_rata'] = 0;
        } else {

            $uang['rata_rata'] = round($pesanan->sum('jumlah') / $uang['baloan']);
        }

        return view('menu.laporan.laporan', compact('pesanan', 'jumlah', 'tanggal', 'uang','pengaturan_tanggal','belanja'));
    }
    public function filter(Request $request){
            
    $pengaturan_tanggal=pengaturan_tanggal::latest()->first();
     $pengaturan_tanggal=$request;
        $tanggal = date('Y-m-d');
        $jumlah         = pengaturan_produk::latest()->first()->jumlah;
        $belanja  = Belanja::where('created_at', '>=', $pengaturan_tanggal->mulai)->where('created_at', '<=', "$pengaturan_tanggal->tutup")->get();
        $pesanan  = Pesanan::where('tanggal', '>=', $pengaturan_tanggal->mulai)->where('tanggal', '<=', "$pengaturan_tanggal->tutup")->get();
        $total_harga    = 0;
        $uang_masuk     = 0;
        $belum_dibayar  = 0;

        for ($i = 0; $i < count($pesanan); $i++) {
            $total_harga += $pesanan[$i]->total_harga();
            $uang_masuk += $pesanan[$i]->total_harga() - $pesanan[$i]->belumDibayar();
            $belum_dibayar += $pesanan[$i]->belumDibayar();
        }
        $uang['masuk'] = $uang_masuk;
        $uang['total'] = $total_harga;
        $uang['diluar'] = $belum_dibayar;
        $uang['pemakaian'] = Pemakaian::where('tanggal', '>=', "$pengaturan_tanggal->mulai")->where('tanggal', '<=', "$pengaturan_tanggal->tutup")->sum('harga');
        $uang['baloan'] = round($pesanan->sum('jumlah') / $jumlah);
        if ($uang['baloan'] == 0) {

            $uang['rata_rata'] = 0;
        } else {

            $uang['rata_rata'] = round($pesanan->sum('jumlah') / $uang['baloan']);
        }

        return view('menu.laporan.laporan', compact('pesanan', 'jumlah', 'tanggal', 'uang','pengaturan_tanggal','belanja'));
    }
   }
